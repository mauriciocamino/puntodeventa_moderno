<!Doctype html>
<head>
    <title>Factura &rarr; <?php echo $recipient_name; ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style type="text/css">
    <?php echo isset($styles) ? $styles : '';?>
    * {
        line-height: 1.444;
    }
    #invoice table {
        width: 100%!important;
    }
    .store-name {
        font-size: 26px!important;
    }
    .no-print, .logo-area {
        display: none!important;
    }
    .text-center {
        text-align: center;
    }
    </style>
</head>
<body>
    <h4>
        <strong>Dear <?php echo $recipient_name; ?>,</strong>
    </h4>
    <p>Gracias por escoger<?php echo $store_name; ?>. Aquí está el resumen de su compra..</p>

    <div id="invoice">
        <?php echo html_entity_decode($body); ?>
    </div>

    <br/><br/><b>Gracias con mis mejores deseos,</b> 
    <br/>Admin, <?php echo $store_name; ?>, <?php echo $store_address; ?>
</body>
</html>