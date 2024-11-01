<div class="wrap">

    <h1>
        <?php echo esc_html($title = __('Generate shortcode for authors page', 'vap')); ?>
    </h1>

    <table class="widefat" id="vap_options">
        <tr id="how-to-show">
            <td class="label">
                <label for="post_type"><?php _e("Generate tags for admins page", 'vap'); ?></label>
            </td>
            <td>
                <ul>
                    <li><label><input type="checkbox" id="roles" name="roles">Roles: </label>
                        <input type="text" id="roles_value" name="roles_value" placeholder="editor,subscriber,etc" disabled="true"><br>
                    </li>
                    <li><label><input type="checkbox" id="authors" name="authors">Exclude authors by id: </label>
                        <input type="text" id="authors_value" name="authors_value" placeholder="0,1,2" disabled="true"><br>
                    </li>
                    <li><label><input type="checkbox" id="counter" name="counter">Counter: </label>
                        <input type="text" id="counter_value" name="counter_value" placeholder="# of posts is %post%" disabled="true"><br>
                    </li>
                    <li><label><input type="checkbox" id="bio" name="bio">Show bio (description)</label></li>
                    <li><label><input type="checkbox" id="avatar" name="avatar">Show avatar</label></li>
                    <li><label><input type="checkbox" id="border" name="border">Show border (around each author)</label></li>
                    <li>
                        <textarea id="vap_tags" cols="50" disabled>[authors_page]</textarea>
                    </li>
            </td>
        </tr>
    </table>


</div>