Lucid Invoices
=======================

Introduction
------------
An extension to custom invoice headers, company description and vat display for each shop.


Installation
------------
Upload application files


Enable Lucid Invoice module
----------------------------


Edit
----------------------------
Add the following lines to
admin/view/template/sale/order_invoice.tpl

replace line 13
 <?php echo ${'lucid_invoice_logo_'.$store_id}; ?>