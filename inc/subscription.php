<?php

if ( ! class_exists( 'WP_List_Table'  )  ) {
  require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php'  );
}


class Customers_List extends WP_List_Table {

  /** Class constructor */
  public function __construct() {

    parent::__construct( [
      'singular' => __( 'Customer', 'sp' ), //singular name of the listed records
      'plural'   => __( 'Customers', 'sp' ), //plural name of the listed records
      'ajax'     => false //should this table support ajax?

    ] );
    $this->bulk_action_handler();

    // screen option
    add_screen_option( 'per_page', array(
      'label'   => 'Показывать на странице',
      'default' => 20,
      'option'  => 'logs_per_page',
    ) );

    $this->prepare_items();

    //add_action( 'wp_print_scripts', [ __CLASS__, '_list_table_css' ] );
  }
  /**
   * Retrieve customer’s data from the database
   * oooooooooiiiiiiiio
   *
   * @param int $per_page
   * @param int $page_number
   *
   * @return mixed
   */
  public static function get_customers( $per_page = 5, $page_number = 1 ) {

    global $wpdb;

    $sql = "SELECT * FROM {$wpdb->prefix}customers";

    if ( ! empty( $_REQUEST['orderby'] ) ) {
      $sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
      $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
    }

    $sql .= " LIMIT $per_page";

    $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;


    $result = $wpdb->get_results( $sql );

    return $result;
  }
  /** Text displayed when no customer data is available */
  public function no_items() {
    _e( 'No customers avaliable.', 'sp' );
  }

  /**
   *  Associative array of columns
   *
   * @return array
   */
  function get_columns() {
    $columns = [
      'cb'      => '<input type="checkbox" />',
      'id' => __('ID'),
      'email' => __( 'Email', 'sp' ),
    ];

    return $columns;
  }


  /**
   * Handles data query and filter, sorting, and pagination.
   */
  public function prepare_items() {

    $this->_column_headers = $this->get_column_info();

    /** Process bulk action */

    $per_page     = $this->get_items_per_page( 'customers_per_page', 5 );
    $current_page = $this->get_pagenum();
    $total_items  = self::record_count();

    $this->set_pagination_args( [
      'total_items' => $total_items, //WE have to calculate the total number of items
      'per_page'    => $per_page //WE have to determine how many items to show on a page
    ] );


    $this->items = $this->get_customers( $per_page, $current_page );
  }

  function column_default($item, $colname) {
    return $item->{$colname};
  }
}
add_action('admin_menu', 'glossier_subscriptions_admin_menu');
function glossier_subscriptions_admin_menu() {
  $hook = add_menu_page(__('Подписчики'), __('Подписки'), 'manage_options', 'dbvv-subscriptions', 'glossier_admin_subscriptions_page', 'dashicons-products', 100);
  add_action("load-$hook", 'glossier_admin_subscription_hook');
}

function glossier_admin_subscription_hook() {
  $GLOBALS['Customers_List'] = new Customers_List();
}

function glossier_admin_subscriptions_page() {
  echo '<div class="wrap">';
  echo '<h2>' . get_admin_page_title() . '</h2>';

  // table
  echo '<form action="" method="POST">';
  $GLOBALS['Customers_List']->display();
  echo '</form>';
  // end table
  echo '</div>';
}

add_action('widgets_init', 'glossier_subscription_widget');
function glossier_subscription_widget() {
  class DBVV_Subscription_Widget extends WP_Widget {
    function __construct() {
      parent::__construct(
        'subscription_widget',
        __('Subscription widget'),
        [
          'description' => __('Subscription form widget'),
        ]
      );

    }

    public function widget($args, $instance) {
      $placeholder = $instance['placeholder'] ? $instance['placeholder'] : '';
      $support_title = $instance['support_title'] ? $instance['support_title'] : '';
      $support_email = $instance['support_email'] ? $instance['support_email'] : '';
      $label = $instance['label'] ? $instance['label'] : '';
      echo $args['before_widget'];
      echo '<div>';
      if ($support_title) {
        echo '<p class="support_title"><b>' . $support_title . '</b></p>';
      }
      if ($support_email) {
        echo '<p class="support_email"><b><a href="mailto:' . $support_email . '">' . $support_email . '</a></b></p>';
      }
      if ($label) {
        echo '<label for="dbvv-subscription-email">' . $label . '</label>';
      }
      echo '<input id="dbvv-subscription-email" placeholder="' . $placeholder . '"/> <br/>';
      echo '<button id="dbvv-subscribe" class="btnnn btn-primary btn-lg" onclick="send_subscription_request()">Подписаться</div>';
      echo '</div>';
      echo '<script>function send_subscription_request() {
        var email = jQuery("#dbvv-subscription-email").val();
        jQuery.ajax({
        url: "/wp-admin/admin-ajax.php",
          method: "POST",
          data: {
          action: "subscribe",
            email: email,
    },
      success: function (data) {
        console.log("data", data);
    },
    });
    }</script>';
echo $args['after_widget'];
    }
    public function form($instance) {
      $placeholder = '';
      if (isset($instance['placeholder'])) {
        $placeholder = $instance['placeholder'];
      }
      $support_title = isset($instance['support_title']) ? $instance['support_title'] : '';
      $support_email = isset($instance['support_email']) ? $instance['support_email'] : '';
      $label = isset($instance['label']) ? $instance['label'] : '';

      // support title
      echo '<p>';
      $field_id_title = $this->get_field_id('support_title');
      $name_title = $this->get_field_name('support_title');
      echo '<label for="' . $field_id_title . '">' . __('title') . '</label>';
      echo '<input class="widefat" id="' . $field_id_title . '" name="' . $name_title . '" type="text" value="' . $support_title . '"/>';
      echo '</p>';
      // end label

      // support email
      echo '<p>';
      $field_id_email = $this->get_field_id('support_email');
      $name_email = $this->get_field_name('support_email');
      echo '<label for="' . $field_id_email . '">Email</label>';
      echo '<input class="widefat" id="' . $field_id_email . '" name="' . $name_email . '" type="email" value="' . $support_email . '">';

      // label
      echo '<p>';
      $field_id_label = $this->get_field_id('label');
      $name_label = $this->get_field_name('label');
      echo '<label for="' . $field_id_label . '">' . __('Label') . '</label>';
      echo '<input class="widefat" id="' . $field_id_label . '" name="' . $name_label . '" type="text" value="' . $label . '"/>';
      echo '</p>';
      // end label

      echo '<p>';
      $field_id = $this->get_field_id('placeholder');
      $name = $this->get_field_name('placeholder');
      echo '<label for="' . $field_id . '">' . __('Placeholder') . '</label>';
      echo '<input class="widefat" id="' . $field_id . '" name="' . $name . '" type="text" value="' . $placeholder . '"/>';
      echo '</p>';
    }

    public function update($new_instance, $old_instance) {
      $instance = [];
      $instance['placeholder'] = (!empty($new_instance['placeholder'])) ? $new_instance['placeholder'] : '';
      $instance['support_email'] = !empty($new_instance['support_email']) ? $new_instance['support_email'] : '';
      $instance['support_title'] = !empty($new_instance['support_title']) ? $new_instance['support_title'] : '';
      $instance['label'] = !empty($new_instance['label']) ? $new_instance['label'] : '';
      return $instance;
    }
  }
  register_widget('DBVV_Subscription_Widget');

  register_sidebar([
    'name' => __('Footer right'),
    'id' => 'footer-right',
  ]);
}

add_action('wp_ajax_nopriv_subscribe', 'glossier_subscribe');
add_action('wp_ajax_subscribe', 'glossier_subscribe');
function glossier_subscribe() {
  if (isset($_POST['email'])) {
    global $wpdb;
    $table_name = "{$wpdb->prefix}customers";
    $email = $_POST['email'];
    $sql = "INSERT INTO $table_name (email) VALUES ('$email')";
    $wpdb->query($sql);
  }
}

add_action('after_switch_theme', 'glossier_create_subscription_database');
function glossier_create_subscription_database() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'customers';
  $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email varchar(256)
  );";
$wpdb->query($sql);
}
