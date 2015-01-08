<title><?php echo $GLOBALS["app_name"];?> - Oops</title>

<?php global $demo; ?>

<div class="page-header">
    <h1>
        Oops
    </h1>
</div>
<div>
    <p>
        <?php echo $viewmodel["EXCEPTION"]->message; ?>
    </p>
    <?php if ($demo) { ?>
    <p>Following only shows in non-production environments to help with debugging:</p>
    <p><?php if ($demo) echo $viewmodel["EXCEPTION"]->printMe($viewmodel["REQUEST_METHOD"]); ?></p>
    <?php } ?>
</div>
