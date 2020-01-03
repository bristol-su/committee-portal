<?php return array (
  'beyondcode/laravel-dump-server' => 
  array (
    'providers' => 
    array (
      0 => 'BeyondCode\\DumpServer\\DumpServerServiceProvider',
    ),
  ),
  'bristol-su/control-db-implementation' => 
  array (
    'dont-discover' => 
    array (
    ),
    'providers' => 
    array (
      0 => 'BristolSU\\ControlDB\\ControlDBServiceProvider',
    ),
  ),
  'bristol-su/support' => 
  array (
    'providers' => 
    array (
      0 => 'BristolSU\\Support\\SupportServiceProvider',
    ),
    'dont-discover' => 
    array (
      0 => 'laravel/passport',
    ),
  ),
  'bristol-su/typeform' => 
  array (
    'providers' => 
    array (
      0 => 'BristolSU\\Module\\Typeform\\ModuleServiceProvider',
    ),
  ),
  'bristol-su/typeform-service' => 
  array (
    'providers' => 
    array (
      0 => 'BristolSU\\Service\\Typeform\\TypeformServiceProvider',
    ),
  ),
  'bristol-su/upload-file' => 
  array (
    'providers' => 
    array (
      0 => 'BristolSU\\Module\\UploadFile\\ModuleServiceProvider',
    ),
  ),
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'itsgoingd/clockwork' => 
  array (
    'providers' => 
    array (
      0 => 'Clockwork\\Support\\Laravel\\ClockworkServiceProvider',
    ),
    'aliases' => 
    array (
      'Clockwork' => 'Clockwork\\Support\\Laravel\\Facade',
    ),
  ),
  'laracasts/utilities' => 
  array (
    'providers' => 
    array (
      0 => 'Laracasts\\Utilities\\JavaScript\\JavaScriptServiceProvider',
    ),
    'aliases' => 
    array (
      'JavaScript' => 'Laracasts\\Utilities\\JavaScript\\JavaScriptFacade',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
  'twigger/unioncloud' => 
  array (
    'providers' => 
    array (
      0 => 'Twigger\\UnionCloud\\API\\UnionCloudServiceProvider',
    ),
  ),
);