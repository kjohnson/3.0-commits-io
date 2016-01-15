<select>
<?php foreach( $forms as $form ): ?>

    <option value="<?php echo $form->get_id(); ?>">
        <?php echo $form->get_setting( 'title' ); ?>
    </option>

<?php endforeach; ?>
</select>