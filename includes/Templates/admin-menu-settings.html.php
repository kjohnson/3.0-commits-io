<div class="wrap">
    <form action="" method="POST">

        <?php foreach( $grouped_settings as $group => $settings ) : ?>
            <div id="ninja_forms_metabox_<?php echo $group; ?>_settings" class="postbox">
                <span class="item-controls">
                    <a class="item-edit metabox-item-edit" id="edit_id" title="Edit Menu Item" href="#">Edit Menu Item</a>
                </span>
                <h3 class="hndle"><span><?php echo $groups[ $group ][ 'label' ]; ?></span></h3>
                <div class="inside" style="">
                    <table class="form-table">
                        <tbody>
                            <?php foreach( $settings as $key => $setting ) : ?>

                                <?php if( 'prompt' == $setting[ 'type' ] ) continue; ?>

                                <tr id="row_<?php echo $setting[ 'id' ]; ?>">
                                    <th scope="row">
                                        <label for="<?php echo $setting[ 'id' ]; ?>"><?php echo $setting[ 'label' ]; ?></label>
                                     </th>
                                <td>
                                    <?php
                                        switch ( $setting[ 'type' ] ) {
                                            case 'desc' :
                                                echo $setting[ 'value' ];
                                                echo "<p class='description'>" . $setting[ 'desc' ] . "</p>";
                                                break;
                                            case 'textbox' :
                                                echo "<input type='text' class='code widefat' name='{$setting['id']}' id='{$setting['id']}' value='{$setting['value']}'>";
                                                echo "<p class='description'>" . $setting[ 'desc' ] . "</p>";
                                                break;
                                            case 'checkbox' :
                                                $checked = ( $setting[ 'value' ] ) ? 'checked' : '';
                                                echo "<input type='hidden' name='{$setting['id']}' value='0'>";
                                                echo "<input type='checkbox' name='{$setting['id']}' value='1' id='{$setting['id']}' class='widefat' $checked>";
                                                echo "<p class='description'>" . $setting[ 'desc' ] . "</p>";
                                        }
                                    ?>
                                </td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>

        <input type="submit" name="update_ninja_forms_settings" class="button button-primary" value="<?php echo $save_button_text; ?>">

    </form>
</div>
