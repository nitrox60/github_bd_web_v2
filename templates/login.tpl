{if isset($login) }
Connecté:{$login} <a href='?module=login&action=deconnect'>Logout</a>
{else}
{$f_log}
{/if}
<!-- Pas utiliser -->