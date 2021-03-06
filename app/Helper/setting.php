<?php
//config crediantials helper
function configDetail($config){
    foreach($config as $key=>$value ){
        $configDetail[$value->key] = $value->value;
        if( $value->key =='country' ){
            $configDetail[$value->value]=$value->value;
        }
    }
    if (isset($configDetail)){
        return $configDetail;
    }else{
        return null;
    }

}

// function validateMisfitEmail($email){
//     $misfitEmail = trim($email);
//     return substr($misfitEmail, -9) === 'xcoder.io';
//     // return substr($misfitEmail, -11) === 'misfit.tech';
// }

//load config info
function configValue($key_name){
    return App\Models\Config\Config::where('key', $key_name)->pluck('value')->first();
}

//load locale name
function getLang($locale){
    $localeName = \App\Models\Translation\Locale::where('locale',$locale)->pluck('name')->first();
    if(! $localeName){
        return '<i class="fa fa-flag"></i>' .$locale;
    }
    $src = url('img/flags/'.strtolower(explode('_', $locale)[1]). '.svg');
    return '<img style="width: 15px;height: 16px" src="' . $src . '"/> ' .  $localeName;
}

function superadmin($field) {
    $superAdmin = \App\User::where('role', 'superadmin')->first();
    return $superAdmin->{$field};
}

