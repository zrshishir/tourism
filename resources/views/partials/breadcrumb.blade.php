<?php
$url = Request::segment(1);
if ($url == '' || $url == 'home') {
    $breadCrumb = trans('common.Dashboard');
} else if ($url == 'customers') {
    $breadCrumb = trans('common.customers');
} else if ($url == 'customer-groups') {
    $breadCrumb = trans('common.customer'). ' '.trans('common.groups');
} else if ($url == 'users') {
    $breadCrumb = trans('common.users');
} else if ($url == 'activities') {
    $breadCrumb = trans('common.Activities');
} else if ($url == 'email-list') {
    $breadCrumb = trans('common.email-list');
} else if ($url == 'message-list') {
    $breadCrumb = trans('common.message_list');
} else if ($url == 'template') {
    $breadCrumb = trans('common.template');
} else if ($url == 'media') {
    $breadCrumb = trans('common.media');
} else if ($url == 'departments') {
    $breadCrumb = trans('common.departments');
} else if ($url == 'send-mail') {
    $breadCrumb = trans('common.send-mail');
} else if ($url == 'package') {
    $breadCrumb = trans('common.package');
} else if ($url == 'history') {
    $breadCrumb = trans('common.history');
} else if ($url == 'tickets') {
    $breadCrumb = trans('tickets.tickets');
} else if ($url == 'sent-email-list') {
    $breadCrumb = trans('common.history');
} else if ($url == 'email_blacklist') {
    $breadCrumb =  trans('blacklist.blacklist');
    $subMenu = trans('blacklist.blacklist').' '.trans('common.email');
} else if ($url == 'word_blacklist') {
    $breadCrumb =  trans('blacklist.blacklist');
    $subMenu = trans('blacklist.blacklist').' '.trans('blacklist.word');
} else if ($url == 'domain_blacklist') {
    $breadCrumb =  trans('blacklist.blacklist');
    $subMenu = trans('blacklist.blacklist').' '.trans('blacklist.domain');
} else if ($url == 'ip') {
    $breadCrumb =  trans('blacklist.blacklist');
    $subMenu = trans('blacklist.blacklist').' '.trans('blacklist.ip');
} else if ($url == 'oauth') {
    $breadCrumb = trans('common.oauth'). ' ' .trans('common.Settings');
    if (Request::get('platform') == 'facebook' || Request::get('platform') == '') {
        $platform = trans('common.facebook');
    } else if (Request::get('platform') == 'google') {
        $platform = trans('common.google');
    } else if (Request::get('platform') == 'twitter') {
        $platform = trans('common.twitter');
    } else if (Request::get('platform') == 'linkedin') {
        $platform = trans('common.linkedin');
    } else if (Request::get('platform') == 'github') {
        $platform = trans('common.github');
    }
} else if ($url == 'system_settings') {
    $breadCrumb =  trans('common.Settings');
    $subMenu = trans('common.system').' '.trans('common.Settings');
} else if ($url == 'email') {
    $breadCrumb =  trans('common.Settings');
    $subMenu = trans('common.email').' '.trans('common.Settings');
} else if ($url == 'api') {
    $breadCrumb =  trans('common.Settings');
    $subMenu =  trans('common.api');
} else if ($url == 'cron') {
    $breadCrumb =  trans('common.Settings');
    $subMenu =  trans('common.cron');
} else if ($url == 'ticketstatus') {
    $breadCrumb =  trans('common.Settings');
    $subMenu =  trans('common.ticketstatus');
} else if ($url == 'paypal-api') {
    $breadCrumb =  trans('common.Settings');
    $subMenu =  trans('common.paypal_api');
} else if ($url == 'stripe-api') {
    $breadCrumb =  trans('common.Settings');
    $subMenu =  trans('common.stripe_api');
} else if ($url == 'coupons') {
    $breadCrumb =  trans('common.Settings');
    $subMenu =  trans('common.coupons');
} else if ($url == 'address') {
    $breadCrumb =  trans('common.Settings');
    $subMenu =  trans('common.physical'). ' ' .trans('common.address');
} else if ($url == 'theme') {
    $breadCrumb =  trans('common.Settings');
    $subMenu =  trans('common.Theme');
} else if ($url == 'translation') {
    $breadCrumb =  trans('common.Settings');
    $subMenu =  trans('common.Translation') ;
} else if ($url == 'profile') {
    $breadCrumb =  trans('common.Profile');
} else if ($url == 'privacy') {
    $breadCrumb =  trans('common.Settings');
    $subMenu =  trans('common.privacy');
} else if ($url == 'purchase-history') {
    $breadCrumb =  trans('common.purchase_history');
} else if ($url == 'pricing') {
    $breadCrumb =  trans('common.package'). ' ' .trans('common.upgrade');
} else if ($url == 'faq-setting') {
    $breadCrumb =  trans('common.faq'). ' ' .trans('common.Settings');
} else if ($url == 'frontend') {
    $breadCrumb =  trans('common.frontend');
} else {
    $breadCrumb = 'N/A';
}
?>
<ol class="breadcrumb">
    <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i></a></li>
    <li class="active">{{ $breadCrumb }}</li>
    @if(isset($platform))
        <li class="active">{{ $platform }} </li>
    @elseif(isset($subMenu))
        <li class="active">{{ $subMenu }} </li>
    @endif
</ol>

