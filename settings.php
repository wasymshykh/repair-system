<?php 

use Ramsey\Uuid\Uuid;

require_once 'app/start.php';
require_once DIR.'app/auth.php';

if (!empty($Settings->fetch('invoice_logo'))) {
    $company_logo = $Settings->fetch('invoice_logo');
}

$error_field = [];

if (isset($_POST) && !empty($_POST)) {

    if (isset($_POST['receipt'])) {

        $changes = [];

        if (isset($_POST['company_name']) && !empty(normal_text($_POST['company_name']))) {
            $company_name = normal_text($_POST['company_name']);

            if ($company_name != $Settings->fetch('invoice_company_name')) {
                $changes['invoice_company_name'] = $company_name;
            }
        } else {
            $error_field['company_name'] = "Company name is required";
        }
        
        if (isset($_POST['address_1']) && !empty(normal_text($_POST['address_1']))) {
            $address_1 = normal_text($_POST['address_1']);
            
            if ($address_1 != $Settings->fetch('invoice_address_1')) {
                $changes['invoice_address_1'] = $address_1;
            }
        } else {
            $error_field['address_1'] = "Address line 1 is required";
        }
        
        if (isset($_POST['address_2']) && !empty(normal_text($_POST['address_2']))) {
            $address_2 = normal_text($_POST['address_2']);
        } else {
            $address_2 = "";
        }

        if ($address_2 != $Settings->fetch('invoice_address_2')) {
            $changes['invoice_address_2'] = $address_2;
        }

        $company_logo_uploaded = false;
        $company_logo_name = "";
        if (isset($_FILES['company_logo']) && is_array($_FILES['company_logo'])) {
            $company_logo_error = false;
            if (isset($_FILES['company_logo']['tmp_name']) && !empty($_FILES['company_logo']['tmp_name'])) {
                $target_dir = DIR."assets/media/uploads/logo/";
                $target_file = $target_dir . basename($_FILES["company_logo"]["name"]);
                
                $image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif" && $image_file_type != "svg" && $image_file_type != "webp") {
                    $error_field['company_logo'] = "Sorry, only jpg, jpeg, png, gif, svg & webp files are allowed.";
                    $company_logo_error = true;
                }

                if (!$company_logo_error) {
                    if ($image_file_type != "svg") {
                        $check = exif_imagetype($_FILES["company_logo"]["tmp_name"]);
                        if (!$check) {
                            $error_field['company_logo'] = "Sorry, submitted file is not an image";
                            $company_logo_error = true;
                        }
                    }
                    if (!$company_logo_error) {
                        if ($_FILES["company_logo"]["size"] > 3000000) {
                            $error_field['company_logo'] = "Sorry, your file is too large. Max. image allowed is 3 MB";
                            $company_logo_error = true;
                        }
            
                        if (!$company_logo_error) {
                            $field_value = Uuid::uuid4()->toString().'.'.$image_file_type;
                            $new_file_path = $target_dir.$field_value;
                            if (!move_uploaded_file($_FILES["company_logo"]["tmp_name"], $new_file_path)) {
                                $error_field['company_logo'] = "Sorry, there was an error uploading your file.";
                            } else {
                                $company_logo_uploaded = true;
                                $company_logo_name = $field_value;
                            }
                        }
                    }
                }
            } else {
                if (isset($_POST['remove_logo']) && $_POST['remove_logo'] == '1') {
                    $error_field['company_logo'] = "Company logo image is required.";
                }
            }
        }

        if ($company_logo_uploaded) {
            if ($company_logo_name != $Settings->fetch('invoice_logo')) {
                $changes['invoice_logo'] = $company_logo_name;
            }
        }

        if (empty($error_field) && empty($errors)) {
            if (!empty($changes)) {
                $result = $Settings->update_settings_multiple ($changes);
                if ($result['status']) {
                    message_move('success', 'Receipt settings has been updated', 'settings.php');
                } else {
                    $errors[] = "Unable to update the receipt settings";
                }
            } else {
                message_move('success', 'Receipt settings is up to date', 'settings.php');
            }
        }

    } else if (isset($_POST['overall'])) {

        $changes = [];

        if (isset($_POST['site_currency']) && !empty(normal_text($_POST['site_currency']))) {
            $site_currency = normal_text($_POST['site_currency']);
            if ($site_currency != $Settings->fetch('site_currency')) {
                $changes['site_currency'] = $site_currency;
            }
        } else {
            $error_field['site_currency'] = "Currency is required";
        }

        if (isset($_POST['invoice_vat_value']) && !empty(normal_text($_POST['invoice_vat_value']))) {
            $invoice_vat_value = normal_text($_POST['invoice_vat_value']);
            if ($invoice_vat_value != $Settings->fetch('invoice_vat_value')) {
                $changes['invoice_vat_value'] = $invoice_vat_value;
            }
        } else {
            $error_field['invoice_vat_value'] = "VAT value is required";
        }
        
        if (isset($_POST['invoice_vat_type']) && !empty(normal_text($_POST['invoice_vat_type']))) {
            $invoice_vat_type = normal_text($_POST['invoice_vat_type']);
            if ($invoice_vat_type != $Settings->fetch('invoice_vat_type')) {
                $changes['invoice_vat_type'] = $invoice_vat_type;
            }
        } else {
            $error_field['invoice_vat_type'] = "VAT value type is required";
        }
        
        if (empty($error_field) && empty($errors)) {
            if (!empty($changes)) {
                $result = $Settings->update_settings_multiple ($changes);
                if ($result['status']) {
                    message_move('success', 'Overall settings has been updated', 'settings.php');
                } else {
                    $errors[] = "Unable to update the overall settings";
                }
            } else {
                message_move('success', 'Overall settings is up to date', 'settings.php');
            }
        }

    }

}


$page_title = "Settings";
$page_type = "settings";

require_once DIR.'views/layout/head.view.php';
require_once DIR.'views/settings.view.php';
require_once DIR.'views/layout/foot.view.php';
