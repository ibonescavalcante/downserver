<?php

/**
 * Configuração à raiz do projeto (irmão de public/, src/).
 * Ajuste $link_hta conforme o URL esperado no modelo HTA.
 */
$link_hta = getenv('LINK_HTA') !== false && getenv('LINK_HTA') !== ''
    ? getenv('LINK_HTA')
    : '/192.168.0.24/vbc/';
