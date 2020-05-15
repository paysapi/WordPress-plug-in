<?php

/**
 * Plugin Name: WooCommerce paysapi-微信
 * Plugin URI: https://paysapi.com/
 * Description: paysapi提供的微信支付
 * Version: 1.0.0
 * Author: paysapi.com
 * Author URI: https://paysapi.com/
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('plugins_loaded', 'init_woocommerce_gateway_paysapi_wechat');

function init_woocommerce_gateway_paysapi_wechat()
{

    if (!class_exists('WC_Payment_Gateway')) {
        return;
    }

    class Paysapi_WC_Payment_Gateway_WeChat extends WC_Payment_Gateway
    {
        public function __construct()
        {
            $this->id = 'paysapi_wechat';
            $this->icon = 'data:image/png;base64,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';
            $this->has_fields = true;
            $this->method_title = 'paysapi-微信';
            $this->method_description = '微信支付 - 中国领先的第三方支付平台 ｜ 微信支付提供安全快捷的支付方式';
            $this->supports = array(
                'products'
            );

            $this->init_form_fields();
            $this->init_settings();

            $this->title = $this->get_option('title');
            $this->description = $this->get_option('description');

            if (is_admin()) {
                add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
            }
            // http://site_url/?wc-api=bapp_wc_payment_gateway
            add_action('woocommerce_api_' . strtolower(get_class($this)), array(&$this, 'handle_callback'));
        }

        public function init_form_fields()
        {
            $this->form_fields = array(
                'app_key' => array(
                    'title' => 'Uid',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'Uid可到paysapi商戶後台(https://www.paysapi.com/mySettingApi)的「接口信息」中查看',
                    'desc_tip' => true,
                ),
                'app_secret' => array(
                    'title' => 'Token',
                    'type' => 'text',
                    'default' => '',
                    'description' => 'Token可到paysapi商戶後台(https://www.paysapi.com/mySettingApi)的「接口信息」中查看',
                    'desc_tip' => true,
                )
            );
        }

        public function payment_fields()
        {
            echo '<p>使用微信支付</p>';
        }

        public function process_payment($order_id)
        {
            global $woocommerce;

            $order = new WC_Order($order_id);
            $notify_url = get_site_url() . '/?wc-api=' . strtolower(get_class($this));
            $return_url = $this->get_return_url($order);

            // $order_id = $order['log_id'];
            $istype = 2;
            $price = (int)$order->order_total;
            $uid= $this->get_option('app_key');
            $token = $this->get_option('app_secret');
            $goodsname = 'WP-' . $order_id;
            $orderuid = "";
            $key = md5($goodsname . $istype . $notify_url . $order_id . $orderuid . $price . $return_url . $token . $uid);
            $url = "https://pay.bearsoftware.net.cn?key="
                    .$key."&notify_url=".urlencode($notify_url)
                    ."&orderid=".$order_id
                    ."&orderuid=".$orderuid
                    ."&return_url=".urlencode($return_url)
                    ."&goodsname=".$goodsname
                    ."&istype=".$istype
                    ."&uid=".$uid
                    ."&price=".$price;
            return array(
                'result' => 'success',
                'redirect' => $url,
            );
        }

        //回调接口
        public function handle_callback()
        {
            $token = $this->get_option('app_secret');
            $paysapi_id = $_POST['paysapi_id'];
            $orderid = $_POST['orderid'];
            $price = $_POST['price'];
            $realprice = $_POST['realprice'];
            $orderuid = $_POST['orderuid'];
            $key = $_POST['key'];

            $temps = md5($orderid . $orderuid . $paysapi_id . $price . $realprice . $token);
            // echo $token."|";
            // echo $temps."|";
            // echo $key."|";

            //检查签名
            if ($temps != $key) {
                echo 'SIGN ERROR';
                die();
            }

            $order = wc_get_order($orderid);
            $order->payment_complete();
            echo 'SUCCESS';
            die();
        }

    }

    function add_gateway_paysapi_wechat_class($gateways)
    {
        $gateways[] = 'Paysapi_WC_Payment_Gateway_WeChat';
        return $gateways;
    }

    add_filter('woocommerce_payment_gateways', 'add_gateway_paysapi_wechat_class');

}
