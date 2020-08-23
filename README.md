
<h2>Order Product</h2>

A project to buy a product in Laravel Framework

<h3>Introduction</h3>
This project makes an application to buy order a product. You can buy a product directly or add it to the basket. 
Although the basket is unavailable for now, the DB has been designed to support multi-products in an order. To order a product,
 first, the customer must choose the product from the list of products wit clicking on the buy button. After that, a checkout form including Customer Info and Card info must be field. Next, the information will be sent to the server to register an order and send a notification email to the administrator. Finally, the details of the order will be shown on another page.
You can see the online version here: 


<hr />
<h4> Technical</h4>  
Used techniques are presented in the following:

Language:
<ul>
<li>PHP 7.2.*</li>
<li>CSS3</li>
<li>JS</li>
<li>HTML5</li>
</ul>

Framework and Library:
<ul>
<li>Laravel version 7.*</li>
<li>Vuejs</li>
<li>Jquery</li>
</ul>

tools:
<ul>
<li>Docker</li>
<li>Compose</li>
<li>Git</li>
</ul>

Other:
<ul>
<li>PHPUnit</li>
<li>Object orinted</li>
<li>SOLID</li>
</ul>

 <hr/>
 
<h3>install</h3> 
 
 1. Clone the source code from github repository. To do that open terminal and type the following command:
  
  <code>
    git clone https://github.com/orderProduct
    </code>
          
 2. Then, open the  orderProduct directory with command: 
 
 <code>cd orderProduct </code>
  
  and run the following commands  to build nginx, php and laravel project to the containers of docker
    
  <code>
        sudo docker-compose up -d
  </code>
      
 
    
 3. Now, the necessary files and software has been installed on your computer. Type the following code to see container on docker service:
 
 <code>
    docker-compose ps
 </code>
you should see something like the following  text after running the above command:


 
    CONTAINER ID        IMAGE                  COMMAND                  CREATED             STATUS              PORTS                                        NAMES
    0e789a2a1d8d        digitalocean.com/php   "docker-php-entrypoi…"   13 hours ago        Up 13 hours         9000/tcp                                     app
    9cb72d04681c        nginx:alpine           "/docker-entrypoint.…"   13 hours ago        Up 13 hours         0.0.0.0:443->443/tcp, 0.0.0.0:8000->80/tcp   webserver




 4. You can now modify the .env file on the app container to include specific details about your setup. You can change 
 the email of administrator in  ADMIN_EMAIL 
    
 
 
 As a final step,  visit http://your_server_ip:8000 in the browser. If you install it in local  <a target="_blank" href="http://http://127.0.0.1:8888" > http://127.0.0.1:8888</a>

##screenshots


![alt text](https://github.com/Javad-Alirezaeyan/fashion/blob/master/screenshots/1.png)
![alt text](https://github.com/Javad-Alirezaeyan/fashion/blob/master/screenshots/2.png)

![alt text](https://github.com/Javad-Alirezaeyan/fashion/blob/master/screenshots/3.png)

![alt text](https://github.com/Javad-Alirezaeyan/fashion/blob/master/screenshots/4.png)

![alt text](https://github.com/Javad-Alirezaeyan/fashion/blob/master/screenshots/5.png)

