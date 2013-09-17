<?php

if (!class_exists('CM_WP_Module_Bootstrap')) {

    class CM_WP_Module_Bootstrap extends CM_WP_Module {

        const CSS_HANDLE = 'bootstrap';
        const JS_HANDLE  = 'bootstrap';

        const CSS_MIN_FILE = 'vendor/twitter/bootstrap/dist/css/bootstrap.min.css';
        const JS_MIN_FILE  = 'vendor/twitter/bootstrap/dist/js/bootstrap.min.js';

        /**
         * Flag to indicate whether to load the bootstrap css file
         *
         * @var boolean
         */
        protected $load_css = false;

        /**
         * Flag to indicate whether to load the bootstrap js file
         *
         * @var boolean
         */
        protected $load_js = false;

        /**
         * Initialises module - automatically called after module is instantiated &
         * configured
         *
         * This is used rather than the constructor to the module to be configured
         * before it's initialised
         * 
         * @return void
         */
        public function initialise() {

            add_action( 'init', array( $this, 'enqueue_files' ) );

            wp_register_style(
                self::CSS_HANDLE,
                $this->uri . self::CSS_MIN_FILE
            );
            wp_register_script(
                self::JS_HANDLE,
                $this->uri . self::JS_MIN_FILE,
                array( 'jquery' ),
                false,
                true
            );
        }

        /**
         * Checks if CSS & JS files need queueing
         *
         * @return void
         */
        public function enqueue_files() {
            if ( $this->load_css ) {
                add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css' ) );
            }
            if ( $this->load_js ) {
                wp_enqueue_script( self::JS_HANDLE );
            }
        }
        
        /**
         * Loads bootstrap into every page
         *
         * @param array $element Which elements to autoload
         *
         * @return void
         */
        public function autoload( $elements = array( 'css', 'js' ) ) {

            foreach ( $elements as $element ) {
                switch ( $element ) {
                    case 'css':
                    case 'js':
                        $this->{"load_$element"} = true;
                        break;
                    default:
                        throw new InvalidArgumentException(
                            "{$element} is not a valid type"
                        );
                }
            }
        }


        /**
         * Enqueues the Bootstrap CSS file
         * 
         * @return void
         */
        public function enqueue_css() {
            wp_enqueue_style( self::CSS_HANDLE );
        }


        /**
         * Enqueues the Bootstrap JS file
         * 
         * @return void
         */
        public function enqueue_js() {
            wp_enqueue_script( self::JS_HANDLE );
        }
    }
}