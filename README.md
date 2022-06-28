# How to Install this Magento 2 module

1.  Create a directory named Amila in app/code under your magento 2 root. 
    
2.  upload _Assignment_ directory to app/code/Amila
    
3.  Run following commands on terminal from your magento root to install and enable the module
   ` php bin/magento setup:update`
    
4. if your magento app is on default or production mode,  please execute below additional steps
   `php bin/magento setup:di:compile && php bin/magento setup:static-content:deploy`
   
5. Clean & flush magento cache using below commands    
   php bin/magento c:c && php bin/magento c:f
   
5. Visit <your magento base url>/assignment/index/index to view the form which helps to test the ported code.
5. Fill various test data and press save button to exercise the ported code 
    
