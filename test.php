<!-- <?php
    /*
        payment_id  customer_name  staff_last_name amount
     */

    SELECT 
        payment.payment_id, 
        customer.name AS customer_name,
        staff.last_name AS staff_last_name,
        payment.amount
    FROM 
        payment 
    INNER JOIN customer ON payment.customer_id = customer.customer_id 
    INNER JOIN staff ON payment.staff_id = staff.staff_id

    

?> -->