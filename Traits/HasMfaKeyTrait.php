<?php


namespace App\Containers\Vendor\Mfa\Traits;


use App\Containers\Vendor\Mfa\Classes\QRGenerator;
use App\Containers\Vendor\Mfa\Classes\TwoFactorAuthenticationProvider as TwoMFA;
use App\Containers\Vendor\Mfa\Models\OtpKey;
use App\Containers\Vendor\Mfa\Tasks\CreateOtpKeyTask;
use App\Containers\Vendor\Mfa\Tasks\FindOtpKeyByUserIdTask;
use App\Containers\Vendor\Mfa\Tasks\UpdateOtpKeyTask;
use App\Containers\Vendor\OtpKey\Classes\TwoFactorAuthenticationProvider as MFA;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Lcobucci\JWT\Exception;

trait HasMfaKeyTrait
{
      public function mfaKey(): MorphOne
      {
            return $this->morphOne(OtpKey::class, 'mfable', 'mfable_type', 'mfable_id');
      }

      public function HasOtp()
      {
            try {
                  return $this->mfaKey()->exists()?$this->mfaKey : false;//app(FindOtpKeyByUserIdTask::class)->run($this->id);
            } catch (Exception $e) {
                  return false;
            }


      }

      public function CreateOtpKey()
      {
            if ($this->HasOtp()) return $this->UpdateKey($this->HasOtp());

            $Code = $this->generateKey();

            $QR = encrypt(app(QRGenerator::class)->twoFactorQrCodeSvg($this->GetQrCode($Code)));

            $this->mfaKey()->create([
                  'code' => encrypt($Code),
                  'qr_code' => $QR,
            ]);
            return $this->mfaKey;
      }


      public function generateKey()
      {
            return app(TwoMFA::class)->generateSecretKey();

      }


      public function UpdateKey()
      {
            $Code = $this->generateKey();
            $QR = encrypt(app(QRGenerator::class)->twoFactorQrCodeSvg($this->GetQrCode($Code)));
            $this->mfaKey()->update([
                  'code' => encrypt($Code),
                  'qr_code' => $QR,
            ]);
            return $this->mfaKey;
      }

      public function GetQrCode($code)
      {
            $Config = config('vendor-Mfa');
            $strAuthUrl = app(TwoMFA::class)->qrCodeUrl(
                  $this->{$this->useMfaLableAttribute()},
                  $Config['application_name'],
                  $code
            );

            return $strAuthUrl;
      }

      public function ValidateKey($Code, $minutes = Null)
      {
            $window = $minutes * 60 / 30;
            $secret = $this->HasOtp();
            if (!$secret) throw new NotFoundException();

            $Check = app(TwoMFA::class)->verify(decrypt($secret->code), $Code, $window);

            return $Check;
      }

      private function GetResponse(OtpKey $OtpRecord)
      {
            return [
                  'code' => $OtpRecord->code,
                  'qr_image' => $this->GetQrCode($OtpRecord->code),

            ];


      }

      public function ActivateMfa()
      {

            $Code = $this->HasOtp();

            return $Code->update(['active' => 1]);
      }


      protected function useMfaLableAttribute()
      {

            $Lable = $this->mfaLable ?? config('vendor-Mfa.mfa_email_attribute');
            return $Lable;


      }


      public function GenerateCode(){
            $MfaKey = $this->HasOtp();
            if($MfaKey) {

                  return app(TwoMFA::class)->GenerateValidOTP(decrypt($MfaKey->code));
            } else{
                  $record =  $this->CreateOtpKey();
                  return app(TwoMFA::class)->GenerateValidOTP(decrypt($record->code));
            }
      }


      public function DeleteMfa(Request $request){
            $MfaKey = $this->HasOtp();
            if($MfaKey) {
                  return $MfaKey->delete();
            } else{
                  throw new NotFoundException('Mfa Key Not Found');
            }
      }

}
