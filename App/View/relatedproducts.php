<select class="form-control form-control-sm relatedproducts" id="relatedproducts" name="relatedproducts[]" multiple>
    <option>Select To Show Related Products</option>
    <?php
    $products = wc_get_products(array('status' => 'publish'));
    foreach ($products as $product) {
        $string_to_array = explode(' , ', $related_products);
        $selected = in_array($product->get_id(), $string_to_array) ? 'selected="selected"' : '';
        ?>
        <option value="<?= esc_attr($product->get_id()); ?>" <?= $selected; ?>> <?php echo esc_html($product->get_name()); ?></option>
        <?php
    }
    ?>
</select>