<?php


namespace App\Containers\Vendor\Mfa\Classes;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Collection;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TwoFactorAuthenticationProvider
{
    protected $engine;

    public function __construct(Google2FA $engine)
    {
        $this->engine = $engine;
    }

    public function generateSecretKey()
    {
        return $this->engine->generateSecretKey();
    }

    public function generateRecoveryCodes($times = 8, $random = 10)
    {
        return Collection::times($times, function () use ($random) {
            return Str::random($random).'-'.Str::random($random);
        })->toArray();
    }

    public function qrCodeUrl( $Name,  $Email,  $secret)
    {
          $Name = trim($Name);
        return $this->engine->getQRCodeUrl($Name, $Email, $secret);
    }

    public function verify(string $secret, string $code, $window = Null)
    {
        return $this->engine->verifyKey($secret, $code, $window);
    }

      /**
       * Find a valid One Time Password.
       *
       * @param string $secret
       * @return bool|int
       */
      public function GenerateValidOTP($secret)
      {

            $startingTimestamp = $this->makeCurretTimestamp();
            return $this->engine->oathTotp($secret, $startingTimestamp);

      }

      /**
       * Get/use a starting timestamp for key verification.
       *
       * @param string|int|null $timestamp
       *
       * @return int
       */
      protected function makeCurretTimestamp($timestamp = null)
      {
            if (is_null($timestamp)) {
                  return $this->engine->getTimestamp();
            }

            return (int)$timestamp;
      }
}
