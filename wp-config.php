<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'igreja');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'F|jlb{7=mdW#R(3-ak>_Y6ElD5~ro!1r##Q|evo@t+h>C0Vf3D7ohj0q}[B!{l=5');
define('SECURE_AUTH_KEY',  '#+.cuQKxWdNL=DbWr5&JjqaN{s]7uKuxO#ikBiAQDJZvY,#($@&nf12vs^z>)?c+');
define('LOGGED_IN_KEY',    'o`.JUr5Lwo)+&jpJe@Z=Z ty[U*Ya2<ovu8$y `veRchl8PkD)/tclJ3@f#c p0.');
define('NONCE_KEY',        '4v5ljwJ)WOtGS0k#detIOhDt><X>^~@-3RA`.!Gad$}l5;${dZ*Q/CO~(*V*<W3E');
define('AUTH_SALT',        'lx.zz]&/]=}SP. iA VixHu{}kRFg@1ZI,)MZ,Q_rMN?DrcGU*W3Qs7Y`*t4-hgr');
define('SECURE_AUTH_SALT', ' 6) dxexW3{BFsaF]4YF5w!A]A=d4rE]2%HHmn7uIIGd3*znxjjD1(o{@%76fc&G');
define('LOGGED_IN_SALT',   'xI^]RK}xX$l{-Qr!nMV<bgvmH#C+?0k5NE}c)MJEa3PFPM]-@pyto^FpWP6L0ES#');
define('NONCE_SALT',       'L?SRH|z}?.`g[)M?{l)sj8}0<b$;)X.7)@m$UW{^0%:Lil!9I`hS?8F6lX;F`8[S');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
