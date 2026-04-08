<?php

/**
 * Configuração à raiz do projeto (irmão de public/, src/).
 * Ajuste $link_hta conforme o URL esperado no modelo HTA.
 */
$link_hta = getenv('LINK_HTA') !== false && getenv('LINK_HTA') !== ''
    ? getenv('LINK_HTA')
    : '/80.32.109.208.host.secureserver.net/vbc/';
