# How to Install & Run This Magento 2 Module

1.  Create a directory named _Amila_ in app/code under your magento 2 root. 

    
2.  upload _Assignment_ directory to app/code/Amila

    
3.  Run following commands on terminal from your magento root to install and enable the module
      ` php bin/magento setup:upgrade && php bin/magento setup:di:compile`  
    
    
4. if your magento app is on  production mode,  please execute below additional steps
   `php bin/magento setup:static-content:deploy`
   

5. Clean & flush magento cache using below commands    
   php bin/magento c:c && php bin/magento c:f
   

6. Visit <your magento base url>/assignment/index/index to view the form which helps to test the ported code.


7. Fill various test data and press save button to exercise the ported code 

    
