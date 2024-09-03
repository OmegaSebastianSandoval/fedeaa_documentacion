<?php foreach ($this->seccion as $key => $value) { ?>
    <option value="<?php echo $key; ?>" <?php if( $this->actual == $key ){ echo "selected"; } ?> ><?php echo $value; ?></option>
<?php } ?>