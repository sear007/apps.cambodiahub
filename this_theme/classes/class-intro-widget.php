<?php
class Intro_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'intro_widget', // Base ID
            esc_html__('Intro Section', 'text_domain'), // Name
            array('description' => esc_html__('An Intro Section Widget', 'text_domain'),) // Args
        );
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
    }


    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'intro-scripts', 
            get_template_directory_uri() . '/assets/admin/js/intro_scripts.js', array('jquery'), 
            '1.0.0.98',
            true,
        );
        wp_enqueue_style(
            'intro-css', 
            get_template_directory_uri() . '/assets/admin/css/intro_style.css',
            null,
            '1.0.0.40',
            'all'
        );
    }

    // Display the widget output in the frontend
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        $socials = !empty($instance['_intro_socials']) ? $instance['_intro_socials'] : [];
        ?>
        <section id="intro" class="s-intro target-section">
            <div class="row s-intro__content width-sixteen-col">
                <div class="column lg-12 s-intro__content-inner grid-block grid-16">
                    <div class="s-intro__content-text">
                        <div class="s-intro__content-pretitle text-pretitle"><?php echo esc_html($instance['_intro_pretitle']); ?></div>
                        <h1 class="s-intro__content-title">
                            <?php echo esc_html($instance['_intro_name']); ?><br>
                            <?php echo esc_html($instance['_intro_title']); ?>
                        </h1>
                        <div class="s-intro__content-btns">
                            <!-- #1 Button -->
                            <?php if(!empty($instance['_intro_button1_text']) && !empty($instance['_intro_button1_link'])) { ?>
                                <a class="smoothscroll btn" href="<?php echo $instance['_intro_button1_link'] ?>"><?php echo $instance['_intro_button1_text'] ?></a>
                            <?php } ?>
                            <!-- #2 Button -->
                            <?php if(!empty($instance['_intro_button2_text']) && !empty($instance['_intro_button2_link'])) { ?>
                                <a class="smoothscroll btn btn--stroke" href="<?php echo $instance['_intro_button2_link'] ?>"><?php echo $instance['_intro_button2_text'] ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>


            <?php if(count($socials) > 0){ ?>
            <ul class="s-intro__social social-list">
                <?php foreach ($socials as $social) { ?>
                    <li>
                        <a href="<?php echo $social['link'];?>">
                            <?php echo $social['svg'];?>
                            <span class="u-screen-reader-text"><?php echo $social['name'];?></span>
                        </a>
                    </li>
               <?php }; ?>
            </ul> <!-- end s-intro__social -->
            <?php }; ?>

            <?php if (!empty($instance['_intro_image'])): ?>
                <div class="s-intro__content-media">
                    <img src="<?php echo esc_url($instance['_intro_image']); ?>" alt="Intro Image">
                </div>
            <?php endif; ?>

            <!-- #3 Button -->
            <?php if(!empty($instance['_intro_button3_text']) && !empty($instance['_intro_button3_link'])) { ?>
                <div class="s-intro__btn-download">
                    <a class="smoothscroll btn btn--stroke" href="<?php echo $instance['_intro_button3_link']?>"><?php echo $instance['_intro_button3_text']?></a>
                </div>
            <?php } ?>

            <div class="s-intro__scroll-down">
                <a href="#about" class="smoothscroll">
                    <div class="scroll-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M11.178 19.569a.998.998 0 0 0 1.644 0l9-13A.999.999 0 0 0 21 5H3a1.002 1.002 0 0 0-.822 1.569l9 13z"></path></svg>
                    </div>
                    <span class="scroll-text u-screen-reader-text">Scroll Down</span>
                </a>
            </div> <!-- s-intro__scroll-down -->

        </section>
        <?php
        echo $args['after_widget'];
    }


    // Widget backend form
    public function form($instance)
    {
        $pretitle = !empty($instance['_intro_pretitle']) ? $instance['_intro_pretitle'] : esc_html__('Hello', 'text_domain');
        $name = !empty($instance['_intro_name']) ? $instance['_intro_name'] : '';
        $title = !empty($instance['_intro_title']) ? $instance['_intro_title'] : '';
        $image = !empty($instance['_intro_image']) ? $instance['_intro_image'] : '';
        $button1Text = !empty($instance['_intro_button1_text']) ? $instance['_intro_button1_text'] : '';
        $button1Link = !empty($instance['_intro_button1_link']) ? $instance['_intro_button1_link'] : '';
        $button2Text = !empty($instance['_intro_button2_text']) ? $instance['_intro_button2_text'] : '';
        $button2Link = !empty($instance['_intro_button2_link']) ? $instance['_intro_button2_link'] : '';
        $button3Text = !empty($instance['_intro_button3_text']) ? $instance['_intro_button3_text'] : '';
        $button3Link = !empty($instance['_intro_button3_link']) ? $instance['_intro_button3_link'] : '';
        $socials = !empty($instance['_intro_socials']) ? $instance['_intro_socials'] : [];
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('_intro_pretitle')); ?>"><?php esc_attr_e('Pretitle:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('_intro_pretitle')); ?>" name="<?php echo esc_attr($this->get_field_name('_intro_pretitle')); ?>" type="text" value="<?php echo esc_attr($pretitle); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('_intro_name')); ?>"><?php esc_attr_e('Name:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('_intro_name')); ?>" name="<?php echo esc_attr($this->get_field_name('_intro_name')); ?>" type="text" value="<?php echo esc_attr($name); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('_intro_title')); ?>"><?php esc_attr_e('Title:', 'text_domain'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('_intro_title')); ?>" name="<?php echo esc_attr($this->get_field_name('_intro_title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <div class="intro-form-image">
            <label for="<?php echo $this->get_field_id('_intro_image'); ?>"><?php _e('Image URL:'); ?></label>
            <div class="form-group">
                <input class="widefat image_input" id="<?php echo $this->get_field_id('_intro_image'); ?>" name="<?php echo $this->get_field_name('_intro_image'); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
                <button class="upload_image_button button button-primary"><?php _e('Upload Image'); ?></button>
            </div>
        </div>
        <div class="intro-form-buttons">
            <div class="intro-form-buttons-collapse-header">
             <span><?php esc_html_e('Group Buttons', 'text_domain'); ?></span>
             <button class="button button-primary intro-form-buttons-collapse-toggle">
                <span>+</span>
             </button>
            </div>
            <div class="intro-form-buttons-collapse-content">
                <div class="button-group">
                    <!-- <label>#1 Button:</label> -->
                    <p><?php esc_attr_e('#1 Button:', 'text_domain'); ?></p>
                    <input class="widefat" placeholder="Text" name="<?php echo esc_attr($this->get_field_name('_intro_button1_text')); ?>" type="text" value="<?php echo esc_attr($button1Text); ?>">
                    <input class="widefat" placeholder="Link" name="<?php echo esc_attr($this->get_field_name('_intro_button1_link')); ?>" type="text" value="<?php echo esc_attr($button1Link); ?>">
                </div>
                <div class="button-group">
                    <!-- <label>#1 Button:</label> -->
                    <p><?php esc_attr_e('#2 Button:', 'text_domain'); ?></p>
                    <input class="widefat" placeholder="Text" name="<?php echo esc_attr($this->get_field_name('_intro_button2_text')); ?>" type="text" value="<?php echo esc_attr($button2Text); ?>">
                    <input class="widefat" placeholder="Link" name="<?php echo esc_attr($this->get_field_name('_intro_button2_link')); ?>" type="text" value="<?php echo esc_attr($button2Link); ?>">
                </div>
                <div class="button-group">
                    <!-- <label>#1 Button:</label> -->
                    <p><?php esc_attr_e('#3 Button:', 'text_domain'); ?></p>
                    <input class="widefat" placeholder="Text" name="<?php echo esc_attr($this->get_field_name('_intro_button3_text')); ?>" type="text" value="<?php echo esc_attr($button3Text); ?>">
                    <input class="widefat" placeholder="Link" name="<?php echo esc_attr($this->get_field_name('_intro_button3_link')); ?>" type="text" value="<?php echo esc_attr($button3Link); ?>">
                </div>
            </div>
        </div>
        <div class="intro-form-socials">
            <div class="intro-form-socials-header">
                <h4><?php esc_html_e('Social Links', 'text_domain'); ?></h4>
                <button class="button button-primary intro-form-socials-collapse-toggle">
                    <span>+</span>
                </button>
            </div>
            <div class="intro-form-socials-container">
            <button
                data-field-name="<?php echo esc_attr($this->get_field_name('_intro_socials')); ?>"
                data-socials-count="<?php echo count($socials);?>"
                data-container-class="social-fields-<?php echo esc_attr($this->get_field_id('_intro_socials'));?>"
                class="add-social button button-primary"><?php esc_html_e('Add more', 'text_domain'); ?></button>
            <div class="social-fields social-fields-<?php echo esc_attr($this->get_field_id('_intro_socials'));?>">
                <?php foreach ($socials as $index => $social): ?>
                    <div class="social-item">
                        <input required class="widefat" type="text" name="<?php echo $this->get_field_name('_intro_socials'); ?>[<?php echo $index; ?>][name]" placeholder="<?php esc_html_e('Name', 'text_domain'); ?>" value="<?php echo esc_attr($social['name']); ?>" />
                        <input required class="widefat" type="text" name="<?php echo $this->get_field_name('_intro_socials'); ?>[<?php echo $index; ?>][link]" placeholder="<?php esc_html_e('Link', 'text_domain'); ?>" value="<?php echo esc_attr($social['link']); ?>" />
                        <input required class="widefat" name="<?php echo $this->get_field_name('_intro_socials'); ?>[<?php echo $index; ?>][svg]" placeholder="<?php esc_html_e('SVG', 'text_domain'); ?>" value="<?php echo esc_attr($social['svg']); ?>" />
                        <button class="remove-social button-link button-link-delete"><?php esc_html_e('Remove', 'text_domain'); ?></button>
                    </div>
                <?php endforeach; ?>
            </div>
            </div>
        </div>
        <?php
    }

    // Updating widget options
    public function update($new_instance, $old_instance)
    {
        var_dump($new_instance);
        $instance = array();
        $instance['_intro_pretitle'] = (!empty($new_instance['_intro_pretitle'])) ? strip_tags($new_instance['_intro_pretitle']) : '';
        $instance['_intro_name'] = (!empty($new_instance['_intro_name'])) ? strip_tags($new_instance['_intro_name']) : '';
        $instance['_intro_title'] = (!empty($new_instance['_intro_title'])) ? strip_tags($new_instance['_intro_title']) : '';
        $instance['_intro_image'] = (!empty($new_instance['_intro_image'])) ? strip_tags($new_instance['_intro_image']) : '';
        if(!empty($new_instance['_intro_button1_text']) &&!empty($new_instance['_intro_button1_link'])){
            $instance['_intro_button1_text'] = strip_tags($new_instance['_intro_button1_text']);
            $instance['_intro_button1_link'] = strip_tags($new_instance['_intro_button1_link']);
        }
        if(!empty($new_instance['_intro_button2_text']) &&!empty($new_instance['_intro_button2_link'])){
            $instance['_intro_button2_text'] = strip_tags($new_instance['_intro_button2_text']);
            $instance['_intro_button2_link'] = strip_tags($new_instance['_intro_button2_link']);
        }
        if(!empty($new_instance['_intro_button3_text']) &&!empty($new_instance['_intro_button3_link'])){
            $instance['_intro_button3_text'] = strip_tags($new_instance['_intro_button3_text']);
            $instance['_intro_button3_link'] = strip_tags($new_instance['_intro_button3_link']);
        }
        $instance['_intro_socials'] = [];
        if (!empty($new_instance['_intro_socials'])) {
            foreach ($new_instance['_intro_socials'] as $social) {
                if (!empty($social['name']) && !empty($social['link']) && !empty($social['svg'])) {
                    $instance['_intro_socials'][] = [
                        'name' => strip_tags($social['name']),
                        'link' => strip_tags($social['link']),
                        'svg' => html_entity_decode($social['svg'])
                    ];
                }
            }
        }
        return $instance;
    }
}