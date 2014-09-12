<?php

	exec("xvfb-run wkhtmltopdf --margin-left 16 /assets/plugins/jquery-file-upload/server/php/files/".$_GET['invoice_no'].".html /assets/plugins/jquery-file-upload/server/pdf/files/".$_GET['invoice_no'].".pdf");
?>