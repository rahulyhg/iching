<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
 
<?php 

foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

    
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
 
<style type='text/css'>
body
{
    font-family: Arial;
    font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
    text-decoration: underline;
}
</style>
</head>
<body>
    <?php 
    echo $this->vars['name'];
    echo "<img style='width:30px' src='/images/hex/small/hexagram".sprintf("%02d",$this->vars['pseq']).".png'>";
    echo " op: ".$this->vars['oname'] ;
    echo "<img style='width:30px' src='/images/hex/small/hexagram".sprintf("%02d",$this->vars['opseq']).".png'>";
    ?>
<!-- Beginning header -->
<!--    <div>
        <a href='< ?php echo site_url('examples/offices_management')?>'>Offices</a> | 
        <a href='< ?php echo site_url('examples/employees_management')?>'>Employees</a> |
        <a href='< ?php echo site_url('examples/customers_management')?>'>Customers</a> |
        <a href='< ?php echo site_url('examples/orders_management')?>'>Orders</a> |
        <a href='< ?php echo site_url('examples/products_management')?>'>Products</a> | 
        <a href='< ?php echo site_url('examples/film_management')?>'>Films</a>
 
    </div>-->
<!-- End of header-->
    <div style='height:20px;'></div>  
    <div>
<?php echo $output; ?>
 
    </div>
<!-- Beginning footer -->
<div>Footer</div>
<!-- End of Footer -->
</body>
</html>
 