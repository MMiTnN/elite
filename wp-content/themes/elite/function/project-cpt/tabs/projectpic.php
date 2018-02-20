<?php
class Projectpic_tab {
    function get_form($post){
        $post_id = $post->ID;
        $projectpic = get_post_meta($post_id, 'projectpic', true);
        ?>
       
        
        <style type="text/css">
            #icon_reimg {
                display: table;
            }
            #icon_reimg li{
                display: table-row;
            }
            #icon_reimg li div{
                display: table-cell;
                padding: 5px 10px;
                vertical-align: middle;
            }
            #icon_reimg .img, #icon_reimg .img img{
                width: 212px;
            }
            #icon_reimg .del{
                width: 30px;
            }
            .dashicons-trash{
                cursor:pointer;
            }
        </style>
        <p>Select image for icon: <input type="button" id="" class="button btn-reimg" value="<?php echo _e('Choose or Upload an Image', '') ?>" /></p>
        <p class="description">Drag item to change order position</p>
        <ul class="sortable" id="icon_reimg" data-rows="<?php echo empty($projectpic) ? 0 : count($projectpic) ?>">
             <?php if(!empty($projectpic)):
                foreach ($projectpic as $key => $id) :
                    $item = get_post($id);
            ?>
            <li class="ui-state-default">
                <input type="hidden" name="projectpic[]" value="<?php echo $id ?>">
                <div class="img"><img class="img-responsive" src="<?php echo wp_get_attachment_url($id) ?>" alt=""></div>
                <div><?php echo basename ( get_attached_file( $id ) ); ?></div>
                <div class="del"><span class='dashicons dashicons-trash'></span></div>
            </li>
            <?php 
                endforeach;
                endif;
            ?>
        </ul>
<!--        <p><button type="button" onclick="update_sticky();" class="button button-primary button-large">Update Settings</button></p>-->
        
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".btn-reimg").on("click", function(){
                    var item_image_frame;
                    var $el = $(this);
                    event.preventDefault();
                    // If the media frame already exists, reopen it.
                    if (item_image_frame) {
                        item_image_frame.open();
                        return;
                    }
                    // Create the media frame.
                    item_image_frame = wp.media.frames.promotion_image = wp.media({
                        // Set the title of the modal.
                        title: $el.data('choose'),
                        button: {
                            text: $el.data('update'),
                        },
                        states: [
                            new wp.media.controller.Library({
                                title: $el.data('choose'),
                                filterable: 'all',
                                multiple: true,
                            })
                        ]
                    });
                    // When an image is selected, run a callback.
                    item_image_frame.on('select', function () {
                        var selection = item_image_frame.state().get('selection');
                        selection.map(function (attachment) {
                            attachment = attachment.toJSON();
                            if (attachment.id) {
                                var dup = false;
                                $("#icon_reimg input[name='projectpic[]']").each(function(i,v){
                                    if($(v).val() == attachment.id){
                                        dup = true;
                                        return false;
                                    }
                                });
                                if(!dup){
                                    var html = "<li class=\"ui-state-default\">"+
                                    '<input type="hidden" name="projectpic[]" value="'+attachment.id+'">'+
                                    '<div class="img"><img class="img-responsive" src="'+attachment.url+'" alt=""></div>'+
                                    '<div>'+attachment.filename+'</div>'+
                                    '<div class="del"><span class="dashicons dashicons-trash"></span></div>'+
                                '</li>';
                                    var html = $(html);
                                    html.find(".dashicons-trash").on("click",function(){
                                        if (confirm('Please Confirm')) {
                                            $(this).parents("li").remove();
                                        }
                                    });
                                    html.appendTo("#icon_reimg");
                                }else{
                                    alert("Duplicate Image");
                                }
                            }
                        });
                    });
                    // Finally, open the modal.
                    item_image_frame.open();
                    return false;
                });
                $("#icon_reimg .dashicons-trash").on("click", function(){
                    if (confirm('Please Confirm')) {
                        $(this).parents("li").remove();
                    }
                });

                $("#icon_reimg").sortable({
                    placeholder: "ui-state-highlight",
                });
                });
        </script>
        <?php
    }
        
    
    function save($post_id){
        delete_post_meta($post_id, 'projectpic');
        add_post_meta($post_id, 'projectpic', $_POST['projectpic']);
    }

}

