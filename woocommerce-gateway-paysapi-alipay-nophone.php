<?php

/**
 * Plugin Name: WooCommerce paysapi-支付宝(不挂机)
 * Plugin URI: https://paysapi.com/
 * Description: paysapi提供的支付宝(不挂机)支付
 * Version: 1.0.0
 * Author: paysapi.com
 * Author URI: https://paysapi.com/
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('plugins_loaded', 'init_woocommerce_gateway_paysapi_alipay_nophone');

function init_woocommerce_gateway_paysapi_alipay_nophone()
{

    if (!class_exists('WC_Payment_Gateway')) {
        return;
    }

    class Paysapi_WC_Payment_Gateway_Alipay_NoPhone extends WC_Payment_Gateway
    {
        public function __construct()
        {
            $this->id = 'paysapi_alipay_nophone';
            $this->icon = 'data:image/png;base64,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';
            $this->has_fields = true;
            $this->method_title = 'paysapi-支付宝(不挂机)';
            $this->method_description = '支付宝，全球领先的独立第三方支付平台，致力于为广大用户提供安全快速的电子支付/网上支付/安全支付/手机支付体验，及转账收款/水电煤缴费/信用卡还款/AA收款等生活服务应用。';
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
            echo '<p>使用支付宝支付</p>';
        }

        public function process_payment($order_id)
        {
            global $woocommerce;

            $order = new WC_Order($order_id);
            $notify_url = get_site_url() . '/?wc-api=' . strtolower(get_class($this));
            $return_url = $this->get_return_url($order);

            // $order_id = $order['log_id'];
            $istype = 6;
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

    function add_gateway_paysapi_alipay_nophone_class($gateways)
    {
        $gateways[] = 'Paysapi_WC_Payment_Gateway_Alipay_NoPhone';
        return $gateways;
    }

    add_filter('woocommerce_payment_gateways', 'add_gateway_paysapi_alipay_nophone_class');

}
