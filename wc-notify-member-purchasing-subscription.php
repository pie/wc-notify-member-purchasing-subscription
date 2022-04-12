<?php
/*
Plugin Name: WC Add Notice of Second Subscription
Description: Adds a notice when validating a WooCommerce cart if an active member tries to purchase a subscription
Version:     0.1
Author:      The team at PIE
Author URI:  http://pie.co.de
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

/* PIE\WCNotifyMemberPurchasingSubscription is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version.

PIE\WCNotifyMemberPurchasingSubscription is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with PIE\WCNotifyMemberPurchasingSubscription. If not, see https://www.gnu.org/licenses/gpl-3.0.en.html */

namespace PIE\WCNotifyMemberPurchasingSubscription;

if ( function_exists( 'wc_memberships_is_user_active_member' ) ) {
  add_filter( 'woocommerce_add_to_cart_validation', 'PIE\WCNotifyMemberPurchasingSubscription\add_purchase_sub_notice', 20, 3 );
  function add_purchase_sub_notice( $valid, $product_id, $quantity ) {
      $user = get_current_user_id();
      if ( $user && wc_memberships_is_user_active_member( $user ) ) {
          wc_add_notice( sprintf( __( 'You already have an active subscription, are you sure you want to create another one? %sView your subscriptions.%s' ), '<a href="' . wc_get_page_permalink( "myaccount" ) . 'subscriptions">', '</a>' ), 'notice' );
      }
      return $valid;
  }
}
