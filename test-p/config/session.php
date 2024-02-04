<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | デフォルトセッションドライバー
    |--------------------------------------------------------------------------
    |
    | このオプションはリクエストに対するデフォルトのセッションドライバーを
    | 指定するためのものです。一番軽いネイティブドライバーを設定していますが
    | 用意されている他の素晴らしいドライバーも使用できます。
    |
    | Supported: "file", "cookie", "database", "apc",
    |            "memcached", "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | セッション持続時間
    |--------------------------------------------------------------------------
    |
    | ここでは何分間接続が無い場合にセッションを破棄するのかを
    | 指定します。もしブラウザを閉じるか、時間切れならすぐに破棄したい
    | 場合は、このオプションを設定してください。
    |
    */

    'lifetime' => env('SESSION_LIFETIME', 120),

    'expire_on_close' => false,

    /*
    |--------------------------------------------------------------------------
    | セッション暗号化
    |--------------------------------------------------------------------------
    |
    | このオプションは全セッションデーターを保存する前に、
    | s暗号化することを簡単に指定できるように用意しています。Laravelにより
    | 全部自動に暗号化されますので、普通にセッションを使用できます。
    |
    */

    'encrypt' => false,

    /*
    |--------------------------------------------------------------------------
    | セッションファイルの場所
    |--------------------------------------------------------------------------
    |
    | "file"セッションドライバーを使用する場合、そのセッションファイルを保存
    | する場所を指定する必要があります。デフォルトは設定していますが、
    | 他の場所を設定することもできます。ファイルセッションでのみ必要です。
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | セッションデータベース接続
    |--------------------------------------------------------------------------
    |
    | "database"か"redis"セッションドライバーを使用する場合、セッションを
    | 管理するために使用するデータベース接続を指定する必要があります。
    | 管理するために使用するデータベース接続を指定する必要があります。
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | セッションデータベーステーブル
    |--------------------------------------------------------------------------
    |
    | "database"セッションドライバーを使用する時には、セッションを管理する
    | テーブルを指定する必要があります。もちろん、分かりやすいデフォルトが
    | 指定されていますが、必要であればご自由に変更してください。
    |
    */

    'table' => 'sessions',

    /*
    |--------------------------------------------------------------------------
    | セッションキャッシュ保存域
    |--------------------------------------------------------------------------
    |
    | While using one of the framework's cache driven session backends you may
    | list a cache store that should be used for these sessions. This value
    | must match with one of the application's configured cache "stores".
    |
    | Affects: "apc", "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | セッションのガベージコレクション確率
    |--------------------------------------------------------------------------
    |
    | いくつかのセッションドライバーは情報の保存場所から古いセッションを
    | クリーンアップする必要があります。ここでは一回のリクエストに対し
    | どのくらいの確率で行うかを指定します。デフォルトでは100回に2回です。
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | セッションクッキー名
    |--------------------------------------------------------------------------
    |
    | ここではセッションインスタンスをIDで識別するために使用されるクッキーの
    | 名前を変更できます。ここで指定された名前はフレームワークにより新しい
    | セッションクッキーが生成されるたび、全てのドライバーに対し使用されます。
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    /*
    |--------------------------------------------------------------------------
    | セッションクッキーパス
    |--------------------------------------------------------------------------
    |
    | セッションクッキーパスはクッキーが有効なパスを決定します。
    | 典型的にはアプリケーションのルートパスを指定しますが
    | 必要に合わせて自由に変更してください。
    |
    */

    'path' => '/',

    /*
    |--------------------------------------------------------------------------
    | セッションクッキードメイン
    |--------------------------------------------------------------------------
    |
    | ここでアプリケーションのセッションを認識するために使用されるクッキーの
    | ドメインを変更できます。これはクッキーが有効なドメインを決めるため
    | 使用されます。デフォルト値は未定義で、納得してもらえると思います。
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | HTTPS専用クッキー
    |--------------------------------------------------------------------------
    |
    | このオプションをtrueに設定することにより、セッションクッキーは
    | ブラウザーがHTTPS接続されている場合のみ、送り返されてきます。
    | the cookie from being sent to you when it can't be done securely.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | HTTPアクセスのみ
    |--------------------------------------------------------------------------
    |
    | この値をtrueにセットすると、JavaScriptがクッキーの値へアクセスすることを
    | 防ぎ、クッキーはHTTPプロトコルを通してのみアクセス可能になります。
    | このオプションは必要に応じ、自由に指定してください。
    |
    */

    'http_only' => true,

    /*
    |--------------------------------------------------------------------------
    | Same-Site Cookies
    |--------------------------------------------------------------------------
    |
    | This option determines how your cookies behave when cross-site requests
    | take place, and can be used to mitigate CSRF attacks. By default, we
    | will set this value to "lax" since this is a secure default value.
    |
    | Supported: "lax", "strict", "none", null
    |
    */

    'same_site' => 'lax',

    /*
    |--------------------------------------------------------------------------
    | Partitioned Cookies
    |--------------------------------------------------------------------------
    |
    | Setting this value to true will tie the cookie to the top-level site for
    | a cross-site context. Partitioned cookies are accepted by the browser
    | when flagged "secure" and the Same-Site attribute is set to "none".
    |
    */

    'partitioned' => false,

];
