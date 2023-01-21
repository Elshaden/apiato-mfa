# [Apiato](https://github.com/apiato/apiato) 2FA Container

### Multi-Factor Authentication MFA  , 2FA.

#### This Container is used to manage the 2 Factor Authentication using any app like Google Authenticator

#### Note: This container is not fully tested, use with caution.

### Installation
Only Works in Existing Apiato Application   <br>
Read more about the Apiato container installer in the [docs](http://apiato.io/docs/miscellaneous/container-installer)!

<br>




#### Steps

> composer require elshaden/apiato-mfa

>> use HasMfaKeyTrait
>
> Add the   ***use HasMfaKeyTrait***    in the User Model or Any Other Model you want to use it with

> Migrate the  table 'otp_keys'

> and you are ready to go

> Check Config File in Configs Dir for any changes

### Usage

#### To find if user has MFA Key

```
$user-> HasOtp();
  ```
This will return the full record of the Otp Key.

```
object   // OtpKey
id          // Hashed OtpKey Id
mfable_id
mfable_type
code      // Base64 OtpKey Code
qr_code    // QR Code Image
created_at
updated_at

 ```
<br>

#### To Create New MFA key
##### Assuming the Model using the HasMfaTrati is the user Nodel
````
$user-> CreateOtpKey();
````
This will return :
The Otp_key Record created
with otp Key ( basse 64 TOTP key)
QR code inform of Base 64 Image
and the user Id

<br>

#### Update the Key

````
$user->UpdateKey();

````
This will regnertae the Key and updates the record

<br>


#### To Verfiy a given Token is valid ( the six numbers in the authenticator)

````
$user->ValidateKey($Code, $slots =1);       // The code must be the six digits in the Authenticator

 ````

<br>

#### Generate Code

````
$user->GenerateCode();
````

This will generate a 6 Digits Code based on the user token, at any given time
The code should match any authenticator App's such as Google Authenticator


<br>

# API Endpoints

if You specify the parameter calss in any call the action will be taken on the class specified.
Classes must be set in the config file, example ***Customer*** , must be specified in the config file
if you do not specify any calss, the action ill be made on the default calss, mostly User

| Endpoint                         | Method |             Parameteres |                                   Usage | Response
|:---------------------------------| ---: |------------------------:|----------------------------------------:| :---:
|  **/mfakeys**                    | POST |     id, (optional)class |                  Creates New User Token |  int "id",  string "code",   image "qr_code" ``
 |  **/validate-mfa**               | POST | id , pin , slots, class |                  Validates 6 digits pin | ``bool "result" ``
 |  **/generate-pin/{id}/{class?}** | GET |                         |                  Generates 6 Digits pin | ``int "code"   ``
 |  **/mfakeys/{id}/{class?}**      | GET |                         | Create  New Mfa and revokes the old one | ``int "code"   ``

In Addition to Find, delete and Update OtpToken for any user.

Note when validating the Otp in  validate-mfa   slots  means validate the key for past minutes.

One Minute slot equal two 30 seconds slots. meaning the number can change once and still the pin can be true.
 
the longer the period the more time it takes to check the validity, so please try to be conservative.















