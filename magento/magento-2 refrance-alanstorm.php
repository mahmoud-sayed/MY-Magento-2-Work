                          ============{{ apologize for any spelling mistake }}============
                            ===================== magento 2 ======================
                            ======================================================
Magento breaks up an HTML page into sections called {{containers}}>>>
Each container holds a nested tree of objects called {{blocks}}>>> Magento block object is the View Model, The block object will do any programmatic reading of the CRUD models
Each block object has a {{phtml template file}}>>>
which specifies the >>  HTML a block object renders.

- inportant explanation for admin menu URL link
    example for URL >>> http://magento.example.xom/admin/cms/page/index/key/ed2ddfe814ba40acb42b6fd4e95be717d32528860c3960d5e178b50e3691e0b0/
    explanation >>> admin: area. All URLs in the Magento admin start with this name
                    Front Name:      cms
                    Controller Name: page
                    Action Name:     index
 
==========================================================================================================================
                        ===================== important notes in magento 2 ===============================
1- <referenceContainer></referenceContainer> is the same like <referenceBlock></referenceBlock> both of them
 - if we but or use any factory word after any word comes from model then here we create new opject that we can use it to bring or create the data from data base 
 - here simple example for defining toDoFactory
                                        <example>
                                         #File: app/code/Pulsestorm/ToDoCrud/Block/Main.php        
                                            function _prepareLayout()
                                            {
                                                $todo = $this->toDoFactory->create();    >>> here we create the toDoFactory opject and save it into a variable to ues it in ge and set functions.

                                                $todo = $todo->load(1);        
                                                var_dump($todo->getData());
                                                exit;
                                            }
                                     </example>
 
2- make shoure the file name is the same like class name 
3- make shoure I have reate all forlders >> for example we > css > style.css
4- don't tuch .htaccess file never ever
5- xml files must be always samll
6- we ues proxy objects for more speed loading our services and objects so our site will run faster and we make that inside di.xml file
7- we have 2 types of __construct($var) variables the >> firest one is able to inject inside another file and we can use it but that happens when this variable alredy hold value inside of him 
                                                  the >> second one is variable we need to inject it but this variable don't hold any value inside of him so in this case we use di.xml file in this way 
                                                       Let’s say we didn’t want $scaler1 to be equal to foo. The object manager and dependency injection block us from using normal constructor parameters, so up until now we’ve been stuck. This is what argument replacement lets us do. Add the following nodes to the di.xml file                                                                                                                                                     
                                                        <example>
                                                         this the variables we want to use and it's not hold any value inside so we will reate it by the object manager and will call it inside the di.xml file to but value for him
                                                         #File: app/code/Pulsestorm/TutorialObjectManagerArguments/Model/Example.php
                                                         <?php    
                                                            #File: app/code/Pulsestorm/TutorialObjectManagerArguments/Model/Example.php  
                                                            namespace Pulsestorm\TutorialObjectManagerArguments\Model;
                                                            class Example
                                                            {
                                                                public $object1;
                                                                public $object2;
                                                                public $scaler1;
                                                                public $scaler2;
                                                                public $scaler3;
                                                                public $thearray;

                                                                public function __construct(
                                                                    ExampleArgument1 $object1,  >> this is a injected object we can not replace it with string but we can replace it with another object  
                                                                    ExampleArgument2 $object2,
                                                                    $scaler1='foo',     >> this is a object can be replaced with string becouse it is not injected object
                                                                    $scaler2=0,
                                                                    $scaler3=false,
                                                                    $thearray=['foo'])        
                                                                {
                                                                    $this->object1 = $object1;
                                                                    $this->object2 = $object2;    

                                                                    $this->scaler1 = $scaler1;
                                                                    $this->scaler2 = $scaler2;
                                                                    $this->scaler3 = $scaler3;        
                                                                    $this->thearray   = $thearray;                
                                                                }
                                                            } 
                                                            ?>
                                                        </example>
                                             
8- why we should use jQuery before rendring any aknouckoutjs function? that becouse if we run the html file what will happen is the all DOM will run firist and after that our function will run that what we use the jQuery like next example>>
                                                        <example>
                                                            jQuery(function(){
                                                                        viewModel = {
                                                                            title:"Hello World",
                                                                            content:"So many years of hello world"
                                                                        }; 
                                                                        ko.applyBindings(viewModel);
                                                                    });
                                                        </example>

------- all xsi:type="something" we will use inside xml files
I've found all types by checking <xs:extension base="argumentType"></xs:extension> in *.xsd files.

lib/internal/Magento/Framework/Data/etc/argument/types.xsd, these are base types:
xsi:type="array"
xsi:type="string"
xsi:type="boolean"
xsi:type="object"
xsi:type="configurableObject"
xsi:type="number"
xsi:type="null"

lib/internal/Magento/Framework/ObjectManager/etc/config.xsd, can be found in di.xml files:
xsi:type="object"
xsi:type="init_parameter"
xsi:type="const"

lib/internal/Magento/Framework/View/Layout/etc/elements.xsd, can be found in layout *.xml files:
xsi:type="options"
xsi:type="url"
xsi:type="helper"

Magento/Ui/etc/ui_components.xsd, can be found in UI components' *.xml files:
xsi:type="constant"
xsi:type="url"


==========================================================================================================================
=================================================== jQuery UI Widgets ====================================================
at many setuations I use the jQuery UI Widgets is all inbut form validation 
-JQUERY UI WIDGETS is JAVASCRIPT FORM VALIDATION >> here we try to make validation by the jquery for more understanding follow this link {https://www.mage2.tv/content/javascript/jquery-ui-widgets/instantiating-jquery-ui-widgets-e.g.-javascript-form-validation/}
    -in this example we will bring content from page NUM 2 to render it in page NUM 1
        <example>
            
            <pageNum1>
                <div data-mage-init='{"collapsible":{"ajaxContent" : true}}'> >> here we use this collaps to do that whene the customer trying to click on any word of this {<h2>How about the collaps </h2>} thne this will show up {this is the collaps content right here} and we use this {"ajaxContent" : true} to make the form accep showing content from the another view
                 <div data-role="title">    >> here we use data-role="title" to tell the magento this div and the contetn of this div is what I'll clock on to show the content
                   <h2>How about the collaps </h2>
                </div>
                 <div data-role="content" style="display: none"> >> we use data-role="content"  to tell magento that thsi is the content will showing up whene I'll click on the title I have mention above 
                     <a href="<?= $block->getViewFileUrl('vendorname_modulename/name-of-another-file.html') ?>" data-ajax="true"></a> >> here in href >> we ask magento to bring the content we have made inside the another paget in place of <a></a> and we write this {tag data-ajax="true"} for acceptnes the ajax 
                 </div>
               </div>
            </pageNum1>
            
            <pageNum2>
                any content wiht javascript or any thisng I write     
            </pageNum2>
        </example>
    
    - if I want to make collapsible inside the collapsible I should watch this video from this link >> https://www.mage2.tv/content/javascript/jquery-ui-widgets/including-dynamic-javascript-in-the-content-loaded-by-ajax-in-a-jquery-ui-widget/
 
==========================================================================================================================
=============================================== understanding knockout js ================================================
here is a explanation for how we use the knockoutjs inside the magento 2>>>> here we have create objects to bind it inside the view
-<example>
  <!-- File: page.html --> 
    <div id="main">
        <div id="one" data-bind="template:{'name':'hello-world','data':first}"></div>

        <div id="two" data-bind="template:{'name':'hello-world','data':second}">
        </div>

        <script type="text/html" id="hello-world">
            <h1 data-bind="text:theTitle"></h1>
            <p data-bind="text:theContent"></p>
        </script>
    </div>
  
  
   <script>
        //File: ko-init.js
        jQuery(function(){
            var viewModelConstructor = function()
            {   
                this.first = {
                    theTitle:ko.observable("Hello World"),
                    theContent:ko.observable("Back to Hello World")
                };
                this.second = {
                    theTitle:ko.observable("Goodbye World"),
                    theContent:ko.observable("We're sailing west now")            
                };            
            }

            viewModel = new viewModelConstructor;
            ko.applyBindings(viewModel);        
        });
    </script>
</example>


example for bind the data feom knockout code to the html code
    <example>
        <!-- This is a *view* - HTML markup that defines the appearance of your UI -->

        <p>First name: <strong data-bind="text: firstName"></strong></p> here we have bind the first name from the AppViewModel() function doun 
        <p>Last name: <strong data-bind="text: lastName"></strong></p>

        <p>First name: <input data-bind="value: firstName" /></p>   >> here we creating input field and this input field holds the firstName value and we bind data throw {data-bind}
        <p>Last name: <input data-bind="value: lastName" /></p>

        <p>Full Name: <strong data-bind="text: fullName"></strong></p>

        <button data-bind="click: capitalizeLastName">Go caps</button>
        
        
        <script>
        // This is a simple *viewmodel* - JavaScript that defines the data and behavior of your UI
            function AppViewModel() {
                this.firstName = ko.observable("Bert"); >> here we sending data by  {this.firstName} 
                this.lastName = ko.observable("Bertington");

                this.fullName = ko.computed(function(){             >> in this function we but the firstName and lastName togither in one place
                return this.firstName() +" "+ this.lastName();
                },this);

                this.capitalizeLastName = function(){           >>here we cacapitalize the name we have but it down inthis step var currentVal = this.lastName();
                    var currentVal = this.lastName();
                    this.lastName(currentVal.toUpperCase());
                    };
            }
            // Activates knockout.js
            ko.applyBindings(new AppViewModel());   >> here we have return all function

        </script>

    </example>
    
this example we bind the data and make foreach item to create the options and I create new row inside the table on click on table 
    <example>
        <h2>Your seat reservations</h2>

        <table>
            <thead><tr>
                <th>Passenger name</th><th>Meal</th><th>Surcharge</th><th></th>
            </tr></thead>
            <tbody data-bind="foreach: seats">
                <tr>
                    <td><input data-bind="value: name" /></td>
                    <td><select data-bind="options: $root.availableMeals, value: meal, optionsText: 'mealName'"></select></td> herewe are defining the seclictions we have made them down there inside the script code
                    <td data-bind="text: formattedPrice"></td>here we add the price 
                </tr>    
            </tbody>
        </table>

        <button data-bind="click: addSeat">Reserve another seat</button>
        
        
        
        <script>
            // Class to represent a row in the seat reservations grid
            function SeatReservation(name, initialMeal) {
                var self = this;
                self.name = name;
                self.meal = ko.observable(initialMeal);

                self.formattedPrice = ko.computed(function() {
                    var price = self.meal().price;
                    return price ? "$" + price.toFixed(2) : "None";        
                });    
            }

            // Overall viewmodel for this screen, along with initial state
            function ReservationsViewModel() {
                var self = this;

                // Non-editable catalog data - would come from the server
                self.availableMeals = [
                    { mealName: "Standard (sandwich)", price: 0 },
                    { mealName: "Premium (lobster)", price: 34.95 },
                    { mealName: "Ultimate (whole zebra)", price: 290 }
                ];    

                // Editable data
                self.seats = ko.observableArray([
                    new SeatReservation("Steve", self.availableMeals[0]),
                    new SeatReservation("Bert", self.availableMeals[0])
                ]);

                // Operations
                self.addSeat = function() {
                    self.seats.push(new SeatReservation("", self.availableMeals[0]));
                }
            }

            ko.applyBindings(new ReservationsViewModel());
        </script>
    </example>

here we add new total price for all prices I have orderd and count how much chair I have Reserved and disaple the button for adding any other chair
    <example>
        <h2>Your seat reservations</h2>

        <table>
            <thead><tr>
                <th>Passenger name</th><th>Meal</th><th>Surcharge</th><th></th>
            </tr></thead>
            <tbody data-bind="foreach: seats">
                <tr>
                    <td><input data-bind="value: name" /></td>
                    <td><select data-bind="options: $root.availableMeals, value: meal, optionsText: 'mealName'"></select></td>
                    <td data-bind="text: formattedPrice"></td>
                    <td><a href="#" data-bind="click: $root.removeSeat">Remove</a></td>
                </tr>    
            </tbody>
        </table>

        <button data-bind="click: addSeat, enable: seats().length < 5">Reserve another seat</button>

        <h3 data-bind="visible: totalSurcharge() > 0">
            Total surcharge: $<span data-bind="text: totalSurcharge().toFixed(2)"></span>
        </h3>
        
        
        <script>
            // Class to represent a row in the seat reservations grid
            function SeatReservation(name, initialMeal) {
                var self = this;
                self.name = name;
                self.meal = ko.observable(initialMeal);

                self.formattedPrice = ko.computed(function() {
                    var price = self.meal().price;
                    return price ? "$" + price.toFixed(2) : "None";        
                });    
            }

            // Overall viewmodel for this screen, along with initial state
            function ReservationsViewModel() {
                var self = this;

                // Non-editable catalog data - would come from the server
                self.availableMeals = [
                    { mealName: "Standard (sandwich)", price: 0 },
                    { mealName: "Premium (lobster)", price: 34.95 },
                    { mealName: "Ultimate (whole zebra)", price: 290 }
                ];    

                // Editable data
                self.seats = ko.observableArray([
                    new SeatReservation("Steve", self.availableMeals[0]),
                    new SeatReservation("Bert", self.availableMeals[0])
                ]);

                // Computed data
                self.totalSurcharge = ko.computed(function() {
                   var total = 0;
                   for (var i = 0; i < self.seats().length; i++)
                       total += self.seats()[i].meal().price;
                   return total;
                });    

                // Operations
                self.addSeat = function() {
                    self.seats.push(new SeatReservation("", self.availableMeals[0]));
                }
                self.removeSeat = function(seat) { self.seats.remove(seat) }
            }

            ko.applyBindings(new ReservationsViewModel());
        </script>
    </example>

her we create a SPA in one nave par
    <example>
        <!-- Todo: Create UI -->
        <ul class="folders" data-bind="foreach: folders">
            <li data-bind="text: $data, css: {selected: $data == $root.chosenFolderId()}, click: $root.goToFolder"></li>
        </ul>
   
       <script>
           function WebmailViewModel() {
                // Data
                var self = this;
                self.folders = ['Inbox', 'Archive', 'Sent', 'Spam'];
                self.chosenFolderId = ko.observable();

                // Behaviours    
                self.goToFolder = function(folder) { self.chosenFolderId(folder); };    
            };

            ko.applyBindings(new WebmailViewModel());
       </script>
    </example>
    
    <example>
        <!-- Folders -->
            <ul class="folders" data-bind="foreach: folders">
                <li data-bind="text: $data, 
                               css: { selected: $data == $root.chosenFolderId() },
                               click: $root.goToFolder"></li>
            </ul>

            <!-- Mails grid -->
            <table class="mails" data-bind="with: chosenFolderData">
                <thead><tr><th>From</th><th>To</th><th>Subject</th><th>Date</th></tr></thead>
                <tbody data-bind="foreach: mails">
                    <tr data-bind="click: $root.goToMail">
                        <td data-bind="text: from"></td>
                        <td data-bind="text: to"></td>
                        <td data-bind="text: subject"></td>
                        <td data-bind="text: date"></td>
                    </tr>     
                </tbody>
            </table>

            <!-- Chosen mail -->
            <div class="viewMail" data-bind="with: chosenMailData">
                <div class="mailInfo">
                    <h1 data-bind="text: subject"></h1>
                    <p><label>From</label>: <span data-bind="text: from"></span></p>
                    <p><label>To</label>: <span data-bind="text: to"></span></p>
                    <p><label>Date</label>: <span data-bind="text: date"></span></p>
                </div>
                <p class="message" data-bind="html: messageContent" />
            </div>
    </example>
    
here I create the table that contain the data inside the SPA 

    <example>
        <!-- Folders -->
        <ul class="folders" data-bind="foreach: folders">
            <li data-bind="text: $data, 
                           css: { selected: $data == $root.chosenFolderId() },
                           click: $root.goToFolder"></li>
        </ul>

        <!-- Mails grid -->
        <table class="mails" data-bind="with: chosenFolderData">
            <thead><tr><th>From</th><th>To</th><th>Subject</th><th>Date</th></tr></thead>
            <tbody data-bind="foreach: mails">
                <tr data-bind="click: $root.goToMail">
                    <td data-bind="text: from"></td>
                    <td data-bind="text: to"></td>
                    <td data-bind="text: subject"></td>
                    <td data-bind="text: date"></td>
                </tr>     
            </tbody>
        </table>

        <!-- Chosen mail -->
        <div class="viewMail" data-bind="with: chosenMailData">
            <div class="mailInfo">
                <h1 data-bind="text: subject"></h1>
                <p><label>From</label>: <span data-bind="text: from"></span></p>
                <p><label>To</label>: <span data-bind="text: to"></span></p>
                <p><label>Date</label>: <span data-bind="text: date"></span></p>
            </div>
            <p class="message" data-bind="html: messageContent" />
        </div>
        
        <script>
            function WebmailViewModel() {
                // Data
                var self = this;
                self.folders = ['Inbox', 'Archive', 'Sent', 'Spam'];
                self.chosenFolderId = ko.observable();
                self.chosenFolderData = ko.observable();
                self.chosenMailData = ko.observable();

                // Behaviours    
                self.goToFolder = function(folder) { 
                    self.chosenFolderId(folder);
                    self.chosenMailData(null); // Stop showing a mail
                    $.get('/mail', { folder: folder }, self.chosenFolderData);
                };
                self.goToMail = function(mail) { 
                    self.chosenFolderId(mail.folder);
                    self.chosenFolderData(null); // Stop showing a folder
                    $.get("/mail", { mailId: mail.id }, self.chosenMailData);
                };

                // Show inbox by default
                self.goToFolder('Inbox');
            };

            ko.applyBindings(new WebmailViewModel());
        </script>
    </example>
    
here we Enabling client-side navigation using sammy.js


                                        +++++++++++++++++++++++++++++++++++++++
                            {{{{{{{{{ Knockout Observables for Javascript Programmers }}}}}}}}}
                            
- ko = requirejs('ko'); >> here we load the Knockout.js library -- normally you'd do this in a `define`

- var objectToHoldMyValue = ko.observable('default value'); >> here we create the observable object with a default value

- if I want to use the list widgets in my jQuery programs I should use it like that >>> {{ we never actually use the listWidget variable in our program. We need to load the mage/list module so that the widget gets defined. However, once defined, we don’t have any need for the actual widget objects returned by the mage/list module. We access the list method directly via the jQuery object.}}
                <example>
                   <script>
                    requirejs([
                                    'jquery',        >> rhis is the jquery 
                                    'mage/list'        >> thid is the list Widget
                                ], function($, listWidget){    >> here we fefine that we will use the jquery and widget
                                    $('#some-node').list({/* ... */});
                                })
                    </script>
                </example>
            here is another example for how to use widget functions this example comes form magento javascript DOC follow this link >> {https://devdocs.magento.com/guides/v2.3/javascript-dev-guide/widgets/widget_calendar.html}
                        <example>
                                                                <div class="field">
                                                                    <label>Date : </label>
                                                                    <input type="text" class="input-text" id="example-date" style="width: auto" name="example-date" />
                                                                </div>

                                                                <script>
                                                                  require([
                                                                    'jquery',
                                                                    'mage/translate',
                                                                    'mage/calendar'
                                                                    ], function ($, $t) {
                                                                      $('#example-date').calendar({
                                                                        changeMonth: true,
                                                                        changeYear: true,
                                                                        showButtonPanel: true,
                                                                        currentText: $t('Go Today'),
                                                                        closeText: $t('Close'),
                                                                        showWeek: true
                                                                      });
                                                                    })
                                                                </script>
                                                            </example>
            here is some example for how to use the widget >> 
                        <example>
                                                                    $(function(){
                                                                        /* ... */
                                                                        $('#someNode').someWidget(/*...*/);   
                                                                    });
                                                                </example>
                
            here is how to define it inside this requirejs >> 
                        <example>
                            requirejs([
                                'jquery',
                                'mage/list'
                            ], function($, listWidget){
                                $('#some-node').list({/* ... config ... */});
                            })
                        </example>
==========================================================================================================================
========================================= require.js refrance and explanation ============================================
            


How to add require.js file to magento files and use it .....>>>>

start example >>> 

1- at firist I should create requirejs-config.js file inside one of this directorys>>

this is the 3 places we will add require.js file inside >>>>

app/code/Package/Module/view/base/requirejs-config.js    
app/code/Package/Module/view/frontend/requirejs-config.js    
app/code/Package/Module/view/adminhtml/requirejs-config.js   

this file will contain the directoryes for js files inside the js files >>

<example>
    <!-- File: require-example.html -->
<!DOCTYPE html>
<html>
    <head>
        <title>My Sample Project</title>
        <!-- data-main attribute tells require.js to load
             scripts/main.js after require.js loads. -->
        <script
            
         data-main="scripts/main" {{this attribute tells require.js to load scripts/main.js after require.js loads}}
             
         src="scripts/require.js"> {{ this is the require.js file who will controle the all thing}}
             
         </script>
    </head>
    <body>
        <h1>My Sample Project</h1>
    </body>
</html>
</example>
                    --------------------------------
                    
RequireJS >>> allows me to set a different base path for my scriptsthis code by this code
this ios how link look like >
before >>> https://example.com/scripts/helper/world.js
after >>> https://example.com/my-javascript-code/helper/world.js 
<example>
require.config({
    baseUrl: '/my-javascript-code',     >>>>> {{this is the name of new URL }}
    
});
</example>
                    --------------------------------
                        
ana RequireJS >>> allows me to change the path above helper/world.js  from URl >> 
>> for example you wanted your helper/world module to be named hello, you’d run the following configuration code somewhere before the start of your program
<example>
require.config({   
    paths: {        
        "hello": "helper/world"
    },
});
</example>
                    --------------------------------
                    
I make this to be able to use jquery in magento and this configuration creates a module named jquery.cookie that points to the jQuery cookie plugin source file in the Package_Module module.
<example>
var config = {
    paths:{
        "jquery.cookie":"Package_Module/path/to/jquery.cookie.min"
    }
};
</example>
                    --------------------------------
                    
this how I start to wright jquery functions in magento file 
<example>
requirejs(['jquery','jquery.cookie'], function(jQuery, jQueryCookie){
    //my code here
});
</example>


==========================================================================================================================
================================================ UI Component magento 2 ==================================================

as a introduction to the UI component this i examples and explanations for them
    <example>
        <!-- File: vendor/magento/module-cms/view/adminhtml/layout/cms_block_index.xml -->
            <!-- ... -->
            <referenceContainer name="content">    {{Get a reference to the already created container named content, and add the cms_block_listing UI Component to it}}
                <uiComponent name="cms_block_listing"/>
            </referenceContainer>
            <!-- ... -->
    </example>

==========================================================================================================================
=============================================== Objects inside magento 2 =================================================
we have to types of clases >> 1- injectable class >> this can be injected directly form the model it self 
                              2- none injectable class >> this cant be injected from model directly but can be injected from resourceModel

here is some way to create Objects inside magento 2 >>>
 1- this exampleabout how to get or show any data from Model >>
               
            here we have three methods >> 
                                            Mage::getModel(...);
                                            Mage::helper(...);
                                            Mage::getSingleton('core/layout')->createBlock(...);   
                <example>
                    #File: app/code/Pulsestorm/TutorialObjectManager1/Command/Testbed.php
                    <?php    
                        protected function execute(InputInterface $input, OutputInterface $output)
                        {
                            $manager = $this->getObjectManager();   >>> this getObjectManager() is helper functions  {{fetches the object manager for us. This is not something you’d normally do when writing a Magento 2 extension}}
                            $object  = $manager->create('Pulsestorm\TutorialObjectManager1\Model\Example');     >>>here we have create like function but the $object variable will do the function work  here We’ve called the object manager’s create method, and passed in a PHP class name as a string {{Behind the scenes, the object manager instantiates a Pulsestorm\TutorialObjectManager1\Model\Example for us}}
                            $message = $object->getHelloMessage();  >> here we called the function that holds the massage 
                            $output->writeln(   >> here we wite the function 
                                $message        >> this is the variable message
                            );                
                        }  
                    
                    in another worled if we create this function >> at setiuation numper 1 and setiuation 2 and and setiuation 3
                        protected function execute(InputInterface $input, OutputInterface $output)
                        {
                        setiuation 1 << here we have create hew message inside the $object variable and the massege will show as I set
                                        $manager = $this->getObjectManager();                                              
                                        $object  = $manager->create('Pulsestorm\TutorialObjectManager1\Model\Example');        
                                        $object->message = 'Hello PHP!';    >>> here we have create the new message
                                        $output->writeln(
                                            $object->getHelloMessage()  >>> whene we call the message here we are calling whta we set abov
                                        ); 
                                     >>
                    setiuation 2 << here we have call the orignal value from opject manager and will call the original value 
                                    $object  = $manager->create('Pulsestorm\TutorialObjectManager1\Model\Example');        
                                    $output->writeln(
                                        $object->getHelloMessage()
                                    );     
                                >>
                    setiuation 2 << here we call the value that we have set it before inside setiuation 1 
                                    $object  = $manager->get('Pulsestorm\TutorialObjectManager1\Model\Example');  
                                    $output->writeln(
                                        $object->getHelloMessage()
                                    ); 
                        }
                    ?>
                </example>
                
       
==========================================================================================================================
=============================================== Important functions for injection and using ==============================
              
 JsonFactory <example>             
    private $jsonResultFactory;

    public function __construct(
    ...
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory,
    ....
    ) {
    ....
        $this->jsonResultFactory = $jsonResultFactory;
    }
             
    --------------------------------------
             
    After execute() of your controller should return \Magento\Framework\Controller\Result\Json object

    $data = ['firstname' => 'Amit', 'lastname' => 'bera'];
    $result = $this->jsonResultFactory->create();
    $result->setData($data);
    return $result;
              </example>
               
                        
                                          
                
==========================================================================================================================
=============================================== Objects Manager magento 2 ================================================
   
   we have two object manager methods for instantiating objects >>> 
       1- $object  = $manager->create('Pulsestorm\TutorialInstanceObjects\Model\Example');  >> create method will instantiate a new object each time it’s called
       2- $object  = $manager->get('Pulsestorm\TutorialInstanceObjects\Model\Example');    >> get method will instantiate an object once, and then future calls to get will return the same object
       


    here we have 2 type of objects can be injected >> 
                                                     1- we can inject the direct model > example {{Pulsestorm\TutorialObjectPreference\Model\MessageHolderInterface}}
                                                         and we use this injection type when this class able to inject but if this class not able to inject we can use the ResourceModel will define this in step 2
                                                     2- here we will inject the resourceModeladn and we use use this setuation whene we need to inject opject but this opject not able to inject 
                                                         example {}
factory word is used for create instancis of specifies class >>>> example{this->somethingFactory->create();}
opjectManager instantiates any class >>>> example{}
                 
            example for get a object manager and instantiate it <example>
                                                                   #File: app/code/Pulsestorm/TutorialObjectManagerArguments/Command/Testbed.php
                                                                   <?php
                                                                    protected function showPropertiesForObject()
                                                                    {
                                                                        $object_manager = $this->getObjectManager();  >>here>> We fetch an instance of the object manager 
                                                                        $object         = $object_manager->create('Pulsestorm\TutorialObjectManagerArguments\Model\Example'); >>and use>>  it to instantiate an object from {{Pulsestorm\TutorialObjectManagerArguments\Model\Example class.}}
                                                                        $properties     = get_object_vars($object); >>>> Then, using PHP’s built-in global get_object_vars function, we fetch an array of the Example object’s properties, and then for each of these we pass the property to the reportOnVariable method
                                                                        foreach($properties as $name=>$property)
                                                                        {
                                                                            $this->reportOnVariable($name, $property);       
                                                                        }
                                                                    }
                                                                    ?>
                                                                </example>
            example for how do 
                 
==========================================================================================================================
================================================ proxy object  magento 2 =================================================

use proxy objects in situations where
1-You have a slow loading dependency
2-You know your particular use of this code doesn’t need the dependency
      
       this is example for the class of proxy object and all proxy objects will have the same three arguments
        <example>
            #File: var/generation/Pulsestorm/TutorialProxy1/Model/SlowLoading/Proxy.php
            <?php
            namespace Pulsestorm\TutorialProxy1\Model\SlowLoading;

            class Proxy extends \Pulsestorm\TutorialProxy1\Model\SlowLoading
            {
                //...
                public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Pulsestorm\\TutorialProxy1\\Model\\SlowLoading', $shared = true)
                {
                    $this->_objectManager = $objectManager;
                    $this->_instanceName = $instanceName;
                    $this->_isShared = $shared;
                }
                //...
            }
            ?>
        </example>
        
==========================================================================================================================
================================================ Creating the Plugin magento 2 ===========================================

we have 3 defrant types of plugins
1- before
2- after
3- around

to create new plugin should follow the next steps:: >>> {if you want to know any  more description go to di.xml file below}
    1- write this in di.xml file >> 
        #File: app/code/Pulsestorm/TutorialPlugin/etc/di.xml
        <config>   

            <type name="Pulsestorm\TutorialPlugin\Model\Example">
                <plugin name="pulsestorm_tutorial_plugin_model_example_plugin" 
                        type="Pulsestorm\TutorialPlugin\Model\Example\Plugin" 
                        sortOrder="10" 
                        disabled="false"/>
            </type>
        </config>
    2- create this >> #File: app/code/Pulsestorm/TutorialPlugin/Model/Example/Plugin.php
                <?php
                namespace Pulsestorm\TutorialPlugin\Model\Example;
                class Plugin
                {
                        public function afterGetMessage($subject, $result) >> this one will call the __METHOD__ after get method
                        {
                            echo "Calling " , __METHOD__,"\n";  
                            return $result;
                        }  
                    
                        public function beforeGetMessage($subject, $thing='World', $should_lc=false) >> >> this one will call the __METHOD__ before get method
                        {
                            echo "Calling " . __METHOD__,"\n";
                        }
                    
                        
                }
                ?>
                
    3- sort order have special case here I will but photo outside with name {how_Plugins_Run} this defininghow the functions inside plugins run
        
    4- in this step I will show how can I make plugins working on my way I will tell them how will run firest :-
        <example>
            - vendorNmae >>>>
                        - moduleName >>>>
                                    - etc >>>>
                                            - frontend >>>> we create this file to controle the plugins will work inside the front end area and how them will work I mean how will run first
                                                    -di.xml >> 
                                                        <example>
                                                           <?xml version="1.0" encoding="UTF-8"?>
                                                            <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
                                                                <type name="Magento\Catalog\Api\ProductRepositoryInterface"> {{here we define the type name of module A }}
                                                                    <plugin name="pulsestorm_pluginexampleA" sortOrder="20"/> {here we make the sort order 20 so this pluign will run after bluginB}
                                                                    <plugin name="pulsestorm_pluginexampleB" sortOrder="10"/>    {this will run befor pluginA}
                                                                </type>
                                                            </config>
                                                            
                                                        </example>
                                            -module.xml
                                                    <example>
                                                        <?xml version="1.0"?>
                                                            <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
                                                                <module name="Pulsestorm_PluginExample" setup_version="1.0.0">
                                                                    <sequence>
                                                                        <module name="pulsestorm_pluginexampleA"/>
                                                                        <module name="pulsestorm_pluginexampleB"/>
                                                                    </sequence>
                                                                </module>
                                                            </config>
                                                    </example>
                                            
                                    -registration.php
                                                <example>
                                                    <?php
                                                        \Magento\Framework\Component\ComponentRegistrar::register(
                                                            \Magento\Framework\Component\ComponentRegistrar::MODULE,
                                                            'Pulsestorm_PluginExample',
                                                            __DIR__
                                                        );
                                                    ?>
                                                </example>
                       -moduleNameA >>>>
                       
                       -moduleNameB >>>>
        </example>
        
==========================================================================================================================
=============================================== Built in functions in magento 2 ==========================================

- setActiveMenu('Magento_Catalog::catalog_attributes_sets'); >> here we define the admin menue Ite that I want to activete 

- resultForwardFactory >> 

- dispatch('catalog_product_new_action', ['product' => $product]) >> 

- _coreRegistry >> 

----------- sessions -------------
- Magento\Backend\Model\Session– This session is used for Magento backend.

- Magento\Catalog\Model\Session– Catalog session is used for the frontend for product filters.

- Magento\Checkout\Model\Session– Checkout session is used to store checkout related information.

- Magento\Customer\Model\Session– Customer session is used for customer, frontend login and all other activities.

- Magento\Newsletter\Model\Session– For newsletter data.



==========================================================================================================================
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
==========================================================================================================================
================================================== Magento 2 Pathes ======================================================
---------- the path of files and what it's do and for what I did this file send the info or render from ----------
    

- VendorName
            - ModuleName
                        -Block >>>> this file contain php files for adminhtml and frontend ill bring and sent data to databse to the view and any other place
                              - Adminhtml >>>> this directory will work on admin side only fro CRUD stuff we just define that any php files here bace to the admin side so this file name we never define it in any file referencein inamageto code
                                          - Options >>>> directory before the php file just naming for directory 
                                                    - Edit.php >>>> this is the efective php file will have all functions will work on all functions and every thing I need
                                                                <example>
                                                                    <?php

                                                                        namespace Tutorial\SimpleNews\Block\Adminhtml\News;

                                                                        use Magento\Backend\Block\Widget\Form\Container;
                                                                        use Magento\Backend\Block\Widget\Context;
                                                                        use Magento\Framework\Registry;

                                                                        class Edit extends Container
                                                                        {
                                                                           /**
                                                                             * Core registry
                                                                             *
                                                                             * @var \Magento\Framework\Registry
                                                                             */
                                                                            protected $_coreRegistry = null;

                                                                            /**
                                                                             * @param Context $context
                                                                             * @param Registry $registry
                                                                             * @param array $data
                                                                             */
                                                                            public function __construct(
                                                                                Context $context,
                                                                                Registry $registry,
                                                                                array $data = []
                                                                            ) {
                                                                                $this->_coreRegistry = $registry;
                                                                                parent::__construct($context, $data);
                                                                            }

                                                                            /**
                                                                             * Class constructor
                                                                             *
                                                                             * @return void
                                                                             */
                                                                            protected function _construct()
                                                                            {
                                                                                $this->_objectId = 'id';
                                                                                $this->_controller = 'adminhtml_news';
                                                                                $this->_blockGroup = 'Tutorial_SimpleNews';

                                                                                parent::_construct();

                                                                                $this->buttonList->update('save', 'label', __('Save'));
                                                                                $this->buttonList->add(
                                                                                    'saveandcontinue',
                                                                                    [
                                                                                        'label' => __('Save and Continue Edit'),
                                                                                        'class' => 'save',
                                                                                        'data_attribute' => [
                                                                                            'mage-init' => [
                                                                                                'button' => [
                                                                                                    'event' => 'saveAndContinueEdit',
                                                                                                    'target' => '#edit_form'
                                                                                                ]
                                                                                            ]
                                                                                        ]
                                                                                    ],
                                                                                    -100
                                                                                );
                                                                                $this->buttonList->update('delete', 'label', __('Delete'));
                                                                            }

                                                                            /**
                                                                             * Retrieve text for header element depending on loaded news
                                                                             * 
                                                                             * @return string
                                                                             */
                                                                            public function getHeaderText()
                                                                            {
                                                                                $newsRegistry = $this->_coreRegistry->registry('simplenews_news');
                                                                                if ($newsRegistry->getId()) {
                                                                                    $newsTitle = $this->escapeHtml($newsRegistry->getTitle());
                                                                                    return __("Edit News '%1'", $newsTitle);
                                                                                } else {
                                                                                    return __('Add News');
                                                                                }
                                                                            }

                                                                            /**
                                                                             * Prepare layout
                                                                             *
                                                                             * @return \Magento\Framework\View\Element\AbstractBlock
                                                                             */
                                                                            protected function _prepareLayout()
                                                                            {
                                                                                $this->_formScripts[] = "
                                                                                    function toggleEditor() {
                                                                                        if (tinyMCE.getInstanceById('post_content') == null) {
                                                                                            tinyMCE.execCommand('mceAddControl', false, 'post_content');
                                                                                        } else {
                                                                                            tinyMCE.execCommand('mceRemoveControl', false, 'post_content');
                                                                                        }
                                                                                    };
                                                                                ";

                                                                                return parent::_prepareLayout();
                                                                            }
                                                                        }?>
                                                                </example>
                              - Main.php >>> {{here we define the toDoFactory from {{Model/ResourceModel/Options.php}}we take the class name becouse the resourcmodel have the abelety to fitch and set data to database}}this is another example for creating the block with more details from alan storm 
                                       If I didn't understand I shoud go to this link directly <a>https://alanstorm.com/magento_2_crud_models_for_database_access/</a>
                                        <example>
                                            #File: app/code/Pulsestorm/ToDoCrud/Block/Main.php    {{What we’ve done here is use automatic constructor dependency injection to inject a Pulsestorm\ToDoCrud\Model\TodoItemFactory factory object, and assign it to the toDoFactory object property in the constructor method.}}
                                                <?php
                                                namespace Pulsestorm\ToDoCrud\Block;
                                                class Main extends \Magento\Framework\View\Element\Template
                                                {
                                                    protected $toDoFactory;
                                                    public function __construct(
                                                        \Magento\Framework\View\Element\Template\Context $context,
                                                        \Pulsestorm\ToDoCrud\Model\TodoItemFactory $toDoFactory     >>> this item name comes form the model class naming we bring the name and define fatroey word after it then  here the factory will create the opject to pring the data throiu
                                                    )
                                                    {
                                                        $this->toDoFactory = $toDoFactory;  >>> here we difine te item as var 
                                                        parent::__construct($context);
                                                    }

                                                    function _prepareLayout()
                                                    {
                                                        var_dump(
                                                            get_class($this->toDoFactory)   >>> here we get the data we have set it before into
                                                        );
                                                        exit;
                                                    }
                                                }?>
                                        </example>  
                                        here simple example for defining toDoFactory
                                        <example>
                                            #File: app/code/Pulsestorm/ToDoCrud/Block/Main.php        
                                                 function _prepareLayout()
                                                 {
                                                  $todo = $this->toDoFactory->create();    >>> here we create the toDoFactory opject and save it into a variable to ues it in ge and set functions.

                                                  $todo = $todo->load(1);        
                                                   var_dump($todo->getData());
                                                    exit;
                                                 }
                                         </example>
                                        another way to use 
                                        <example>
                                            #File: app/code/Pulsestorm/ToDoCrud/Block/Main.php          
                                            function _prepareLayout()
                                            {
                                                $todo = $this->toDoFactory->create();

                                                $collection = $todo->getCollection();

                                                foreach($collection as $item)
                                                {
                                                    var_dump('Item ID: ' . $item->getId());
                                                    var_dump($item->getData());
                                                }
                                                exit;
                                            }?>
                                        </example>
                                                                
                                       
                        - etc >>>> this file containg most of basic forlder my module need
                             - di.xml >>>> here we tell magento what object you sould call and there is a lot of cases {we use this file to run this objects we have create it before for fast loading because objects take a 3 seconds to loade but whene we replace the object full name and path with argument name this make it loade in just 3 ms}
                                        this is the php file I will use it <example>
                                                                               #File: app/code/Pulsestorm/TutorialObjectManagerArguments/Model/Example.php
                                                                                <?php    
                                                                                namespace Pulsestorm\TutorialObjectManagerArguments\Model;
                                                                                class Example
                                                                                {
                                                                                    public $object1;
                                                                                    public $object2;
                                                                                    public $scaler1;
                                                                                    public $scaler2;
                                                                                    public $scaler3;
                                                                                    public $thearray;
                                                                                    const SETUP_TYPE = 'setup_type';

                                                                                    public function __construct(
                                                                                        ExampleArgument1 $object1,
                                                                                        ExampleArgument2 $object2, this is a injected object we can not replace it with string but we can replace it with another object like what we have write it here and this is how it is look like the injected object
                                                                                        $scaler1='foo',
                                                                                        $scaler2=0,
                                                                                        $scaler3=false,
                                                                                        $thearray=['foo'])        
                                                                                    {
                                                                                        $this->object1 = $object1;
                                                                                        $this->object2 = $object2;    

                                                                                        $this->scaler1 = $scaler1;
                                                                                        $this->scaler2 = $scaler2;
                                                                                        $this->scaler3 = $scaler3;        
                                                                                        $this->thearray   = $thearray;                
                                                                                    }
                                                                                } 
                                                                                ?>
                                                                            </example>
                                     <example>
                                         <?xml version="1.0" encoding="UTF-8"?>
                                            <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
                                                <type name="Pulsestorm\ObjectSystem\Example\Dependency" shared="false"> {{So, the <type/> node lets us tell Magento 2 which class’s argument we want to target}} {shared="true" >> is the default, and you’ll get a singleton-ish/global object}{shared="false", the automatic constructor dependency injection system will start instantiating a new parameter every-time a programmer instantiates the attribute’s owner object}
                                                    <preference {{we use this preference to create any newInterface or somethingFactory or new opjectManager}}
                                                                   for="Pulsestorm\TutorialObjectPreference\Model\MessageHolderInterface"{{ we use preference to reference some model that will make some code work to getMessage() from database or setMessage() to database}} {{here we say When someone asks you to instantiate this one thenw use thenext type}}{{in for item we write where this new creatoin thing should begin and in type="here we write the class have the funtions that will work with get and set methods"}}
                                                                    type="Pulsestorm\TutorialObjectPreference\Model\English" {{ this one it what will be used when we ask him to use the for attribute }}
                                                    />
                                                </type>
                                                
                                                <type name="vendorNmae\ModuleName\filename\nameOfClassThat we will pring the class that we will overwrite on">{{in name="we wright here the class that the object we will use it or call it inside of the next class I want to effect to}}
                                                   <arguments>
                                                       <argument name="example" {{this name is the name of the variable I have create it inside the file will create the example variable}}
                                                                   xsi:type="object" {here we definig the we createing a opject}
                                                                   >vendorName\ModuleName\nameOfFile\NameOfTheClassWeHave</argument> {this is a injected object we can replace it with string that we have create it by the virtualType and we can replace it with another object like what we have write it here and this is how it's look like the injected object public function __construct(
                                                                                                                                                                                                                                                                                                                                                                                                    ExampleArgument1 $object1,

                                                                                                                                                                                                                                                                                                                                                                                                )}
                                                   </arguments>
                                                </type>
                                                
                                                <type name="Pulsestorm\TutorialObjectManagerArguments\Model\Example"> {{name="refers to the class whose arguments we’re trying to change"}} So, the <type/> node lets us tell Magento 2 which class’s argument we want to target
                                                    <arguments>
                                                        <argument name="example" {{ name="this is the name of variable has been injected inside the constructor function in here {Pulsestorm\TutorialObjectManagerArguments\Model\Example}"}} we do that The object manager and dependency injection block us from using normal constructor parameters This is what argument replacement lets us do inside di.xml file
                                                         xsi:type="string"    {{here we define the type of value we will pss here}}
                                                         >any string or value</argument> {{this is the value}}
                                                    </arguments>
                                                </type>
                                                
                                                <type name="vendorNmae\ModuleName\filename\nameOfClassThat we will pring what we have create it and will call it inside of the name">
                                                  <arguments>
                                                      <argument name="example" xsi:type="number">57</argument> here we pass a number if I face problem with passing number we will work on the 
                                                  </arguments>
                                                </type>
                                                   
                                                <type name="Pulsestorm\TutorialObjectManagerArguments\Model\Example">
                                                    <arguments>
                                                        <argument name="scaler2" { name="this is the name of variable has been injected inside the constructor function"}}
                                                                     xsi:type="const"    {here we define that we use this for adding value to the const variable}
                                                                     >Magento\Integration\Model\Integration::SETUP_TYPE</argument> {So — where did the setup_type value come from? The const value in xsi:type allows you to insert the value of a class constant}
                                                    </arguments>
                                                </type>
                                                
                                                <type name="Magento\Catalog\Api\ProductRepositoryInterface">    {}{name="the class whose behavior you’re trying to change I mean the class I want to chane it"}
                                                    <plugin name="pulsestorm_pluginexample"     {name="uniqe name for plugin I can use the vendorname_modulename"}
                                                            type="Pulsestorm\PluginExample\Plugin\ProductRepositoryExamplePlugin" {the path of my file that contain my code}
                                                            sortOrder="10"     {this sort order have big }
                                                            disabled="false"/> {disabled="this is for disabl this plugin or no"}
                                                </type>
                                                
                                                <type name="Pulsestorm\TutorialObjectManagerArguments\Model\Example"> {this is the calss we will take the value from to buta new value for}
                                                    <arguments>
                                                        <argument name="thearray" xsi:type="array">    {here we replaced the default array with a multiple item, mixed key array}
                                                            <item name="0" xsi:type="string">science</item>
                                                            <item name="baz" xsi:type="string">baz</item>    { here we define (baz) as an array key and it will interpret the tag contents (baz) as the value}
                                                            <item name="bar" xsi:type="string">bar</item>
                                                            <item name="baz" xsi:type="string">Some\Php\Class</item> { here we can define a array key as object alredy injected form anothe class}
                                                            
                                                            <item name="baz" xsi:type="string"> {here we define the nested arrays}
                                                                <item name="0" xsi:type="string">one</item>
                                                                <item name="1" xsi:type="string">two</item>        
                                                            </item> 
                                                        </argument>
                                                    </arguments>
                                                </type>
                                                
                                                 <virtualType name="ourVirtualTypeName"       {name="name of class name I have create it and this class extendes from some real working another class alredy do some thing"} 
                                                  type="Pulsestorm\TutorialVirtualType\Model\Argument1">  this is the example class >> class OurVirtualTypeName extends \Pulsestorm\TutorialVirtualType\Model\Argument1{} 
                                                 </virtualType> >> we use this virtualType in place of {xsi:type="object"} in above example, so what we are tring to do here is creating new object with all new path for this object by virtualType I'll explane this by the nest example
                                                                         <example>
                                                                             here we want to create new virtualType name>> name="ourVirtualTypeName" for {Pulsestorm\TutorialVirtualType\Model\Argument1} and create this name as new object able to use 
                                                                             <config>
                                                                                <virtualType name="ourVirtualTypeName" type="Pulsestorm\TutorialVirtualType\Model\Argument1">  >> here we hae create the new virtualType name {name="ourVirtualTypeName"} for {Pulsestorm\TutorialVirtualType\Model\Argument1}
                                                                                </virtualType>        

                                                                                <type name="Pulsestorm\TutorialVirtualType\Model\Example"> >> this is the class we get that name from {argument name="the_object"} 
                                                                                    <arguments>
                                                                                        <argument name="the_object" xsi:type="object">ourVirtualTypeName</argument> >> here we have call the name we have create it for the class up there{Pulsestorm\TutorialVirtualType\Model\Argument1} and this is A new object name able to use and this object can do all of what Argument1 do 
                                                                                    </arguments>
                                                                                </type>        

                                                                            </config>
                                                                         </example>
                                                                in the next I we explane another case and that case is we will change full class path like that {Pulsestorm\TutorialVirtualType\Model\Argument1} to new name by virtualType  like that {name="ourVirtualTypeName"} and will call a variable from this path inside and argument like that {name="the_argument"} and will replace it with the name I have create it like that {Pulsestorm\TutorialVirtualType\Model\Argument3} after that I'll create new opject in next and step and will contenue the explanation down
                                                                <example>
                                                                    #File: app/code/Pulsestorm/TutorialVirtualType/etc/di.xml    
                                                                    <config>
                                                                        <virtualType name="ourVirtualTypeName" type="Pulsestorm\TutorialVirtualType\Model\Argument1">  here I set new name for this class {type="Pulsestorm\TutorialVirtualType\Model\Argument1"} this is the new name I have set it for the calss {name="ourVirtualTypeName"}
                                                                            <arguments>  >>> here I define that I will set new argument name and we use this argument make object or servicerun in fast loading more than the regular one
                                                                                <argument name="the_argument" xsi:type="object">Pulsestorm\TutorialVirtualType\Model\Argument3</argument> here I have call this name {name="the_argument"} from this class {type="Pulsestorm\TutorialVirtualType\Model\Argument1"} and but new name for it and set it as object by {xsi:type="object"} this is the name I have set {Pulsestorm\TutorialVirtualType\Model\Argument3}.
                                                                            </arguments>
                                                                        </virtualType>

                                                                        <type name="Pulsestorm\TutorialVirtualType\Model\Example"> here I call the class to create new object for this {the_object} variable name to be able to inject inside any other class
                                                                            <arguments>
                                                                                <argument name="the_object" xsi:type="object">ourVirtualTypeName</argument> here I ahve set this name {ourVirtualTypeName} fro this variable {the_object } from this class {Pulsestorm\TutorialVirtualType\Model\Example} to be ablr to injected inside any other class
                                                                            </arguments>
                                                                        </type>  
                                                                    </config>
                                                                </example>
                                            </config>
                                            
                                            ------- all xsi:type="something" we will use inside xml files
                                            I've found all types by checking <xs:extension base="argumentType"></xs:extension> in *.xsd files.

                                            lib/internal/Magento/Framework/Data/etc/argument/types.xsd, these are base types:
                                            xsi:type="array"                >> 
                                            xsi:type="string"               >>
                                            xsi:type="boolean"              >> here we will pas the string we write it inside the argument 
                                            xsi:type="object"               >> we wight this to define that we will create object and call it in tha file path will come in <argument name="e" xsi:type="object">here is the path</argument>
                                            xsi:type="configurableObject"   >>
                                            xsi:type="number"               >>
                                            xsi:type="null"                 >>

                                            lib/internal/Magento/Framework/ObjectManager/etc/config.xsd, can be found in di.xml files:
                                            xsi:type="object"               >> this is a injected object we can not replace it with string but we can replace it with another object
                                            xsi:type="init_parameter"       >>
                                            xsi:type="const"                >>here we  pass the constant we will call  

                                            lib/internal/Magento/Framework/View/Layout/etc/elements.xsd, can be found in layout *.xml files:
                                            xsi:type="options"              >>
                                            xsi:type="url"                  >>
                                            xsi:type="helper"               >>

                                            Magento/Ui/etc/ui_components.xsd, can be found in UI components' *.xml files:
                                            xsi:type="constant"             >>
                                            xsi:type="url"                  >>
                                     </example>
                             - module.xml >>>> 1- naming of the module. 2-declear module version
                                         <example> {{this is a explnation for what module.xml file contain}}
                                             <?xml version="1.0" encoding="UTF-8"?>
                                                <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
                                                    <module name="BestResponseMedia_ContactUs" setup_version="1.2.0"> {{name="vendorNmae_ModuleName" setup_version="the version of your module and we change this when we make any chagne in DB to effect on database it self"}}
                                                            <sequence> {{we write this sequence element to define what module we will make the effection on and the module that we have create it befor have create it by object manager and U can understand this by looking up ther in object manager section}}
                                                                <module name="Magento_Contact"/>{{name="vendorNmae_ModuleName" this is the module we will over write on and by poting this module here magento will run our module after magento module and our change will effet on it}}
                                                            </sequence>
                                                    </module>
                                                </config>
                                         </example>
                             - frontend >>>> 1- containg the route fiels to the front end view
                                       -routes.xml >>>> 1- here we right the routes for the pages {{content of this page}} >> 
                                                        <example>
                                                             <?xml version="1.0"?>
                                                             <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:Magento/Framework/App/etc/routes.xsd">
                                                                 <router id="standard"> >>> here if we wright standerd then we make route for front end site I mena for the clint side 
                                                                      <route id="hello_mvvm" frontName="hello_mvvm">  >>> id and frontName must be the same name and the frontenad name is the name that will show up inthe URL But {{magento uses the first{ id }segment to lookup a <route/> node in the merged XML tree, and then use that route node’s frontName as the first URL segment.}}
                                                                          <module name="Pulsestorm_HelloWorldMVVM" /> >>> this is the name of module nut be defined inght font end name
                                                                       </route>
                                                                  </router>
                                                              </config> 
                                                       </example>
                                                    example for more understanding 
                                                    <example>
                                                        http://magento.example.com/admin/admin/url_rewrite/index  >>> That’s a URL that begins with /admin/admin. That’s two admin strings. The first comes from the /admin URL segment that Magento prepends to every admin URL. The second comes from Magento using the adminhtml route ID to lookup a frontName attribute.
                                                    </example>
                            
                             - adminhtml >>>> 1- containg the route fiels to the admin view
                                        - menu.xml >>>> we use this file to create new admin menu inside the admin page {{note to create parent inside the menu I should just chose the parent I want to use and use his Id as parent attribute for another add item innside the menu and the parnet  will not  be clickbl }}
                                                    <example>
                                                        <?xml version="1.0"?>
                                                            <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Backend:etc/menu.xsd">
                                                                <menu>
                                                                    <add 
                                                                     id="BestResponseMedia_ContactUs::brm"  {{ ModuleName_Vendorname::descrip_for_what_this_module}} the decription for must be small litter and this will be parent for another link like add example down there
                                                                     title="BestResponseMedia"              {{this is the name will show down of the admin menu Icon}}     
                                                                     translate="title"                      {{}}
                                                                     module="BestResponseMedia_ContactUs"   {{ModuleName_Vendorname}}
                                                                     sortOrder="51"                         {{this attribute tells magento where is me new item will show up in the admin menu}}
                                                                     resource="BestResponseMedia_ContactUs::brm"    {{}}
                                                                     />
                                                                    <add
                                                                     id="BestResponseMedia_ContactUs::options"
                                                                     title="Contact Us Subject Options" 
                                                                     translate="title" 
                                                                     module="BestResponseMedia_ContactUs" {{ModuleName_Vendorname}} here we use the name of currnt module we are use
                                                                     sortOrder="10" 
                                                                     parent="BestResponseMedia_ContactUs::brm" {{the Id of the past adminmenou or what kind of }}
                                                                     action="contactus/options/options"     {{action="routenameformadminroutsfile/nameoffillecontainthecontroller/controllername"}}
                                                                     resource="BestResponseMedia_ContactUs::options"    {{we take this from the ACL roule so after while I will be able to give acces to or not to any user on admin page}} this comes from {{}}
                                                                     />

                                                                </menu>
                                                            </config>

                                                    </example>
                                                    after all of that some times I need to use exsisting menue name and use it as parent 
                                                    I can find any menu name by this command {$ find vendor/magento/ -name menu.xml | xargs grep 'title="System"'}
                                        - routes.xml >>>> 1- here we right the routes for the pages {{content of this page}} >> 
                                                            <example>
                                                                <?xml version="1.0" encoding="UTF-8" ?>
                                                                    <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:App/etc/routes.xsd">
                                                                        <router id="admin">    >>> this admin word for make the route send the pade and the show to the admin page 
                                                                            <route id="ContactUs" frontName="ContactUs">    >>> this is the Id must be the same as the front name without any reson 
                                                                                <module name="BestResponseMedia_ContactUs"/>    >>> here we declare the module name 
                                                                            </route>
                                                                        </router>
                                                                    </config>
                                                            </example>
                                                            
                                        - system.xml >>>> 
                             - acl.xml >>>> we create this file to create the admin rules
                                     <example>
                                         <config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Acl/etc/acl.xsd">
                                            <acl>    >>> to tell the xml that I'll write new acl rule 
                                                <resources>
                                                    <resource id="Magento_Backend::admin"> >>> here we define that we creating the rules inside the admin place and 
                                                        <resource id="Pulsestorm_AclExample::top" title="Acl Example">    >>> {{id="vendorNmae_ModuleName::top mean inthe top of all menue I will create and it's just defenation" title="name of folder I want to create"}} and here we create full new folder and we can change what folder we will use or where we will create oure new rule
                                                            <resource id="Pulsestorm_AclExample::second" title="any name folder"> >>> this is just example for tills that I can create new folder
                                                                <resource id="Pulsestorm_AclExample::config" title="First Rule"/>    >>> this is the firist rule 
                                                                <resource id="Pulsestorm_AclExample::more_rules" title="Second Rule"/>
                                                            </resource>
                                                        </resource>
                                                    </resource>
                                                </resources>
                                            </acl>
                                        </config>
                                     </example>
                                     here example for how we can use oure rule inside any function here I inject the auth checking object
                                     <example>
                                         public function __construct(Magento\Framework\AuthorizationInterface $auth)
                                            {
                                                $this->authorization = $auth;
                                            }
                                      </example>
                                      If you’re in a controller that extends the \Magento\Backend\App\Action controller, you automatically have access to the authorization checking object via the _authorization property
                                      <example>
                                          namespace Pulsestorm\HelloAdmin\Controller\Adminhtml\Index;
                                            class Index extends \Magento\Backend\App\Action
                                            {
                                                protected function someControllerMethod()
                                                {
                                                    return $this->_authorization->isAllowed('Pulsestorm_HelloAdmin::pulsestorm_helloadmin_index_index');
                                                }            

                                            }

                                      </example>
                                      
                             - config.xml >>>>     here we add values that will appear in system.xml file and this values will come from model that I should create 
                             
                        - Controller >>>> file containg all controllers that make the actions inside my module
                                    - Adminhtml >>>> this file we create it to contain the admin controllers and any other controller related to front end will be outside of this file and we never use the name of this file inside any URl
                                                - Index >>>> this is the directory to admin controller
                                                        - Index.php >>>> thisis the admin controller with deferant type of functions I should use 
                                                        <example>
                                                            <?php
                                                                namespace BestResponseMedia\ContactUs\Controller\Adminhtml\Options;

                                                                class Options extends \Magento\Backend\App\Action   >>> this ios the defrant from the front end 
                                                                {
                                                                    protected $_pageFactory;
                                                                    protected $_optionFactory;  >>> we create this funtion to just make test 

                                                                    public function __construct(
                                                                        \Magento\Backend\App\Action\Context $context,   >>> this ios the defrant from the front end 
                                                                        \Magento\Framework\View\Result\PageFactory $resultPageFactory

                                                                    )
                                                                    {
                                                                        parent::__construct($context);
                                                                        $this->resultPageFactory = $resultPageFactory;
                                                                    }

                                                                    public function execute()
                                                                    {
                                                                        $resultPage = $this->resultPageFactory->create();
                                                                        $resultPage->getConfig()->getTitle()->prepend((__('Options')));

                                                                        return $resultPage;

                                                                    }
                                                                     protected function _isAllowed()       >>> we add thjis funtion to tell magento if some admin user have permition to this ACL or not show hem or not 
                                                                        {
                                                                            return $this->_authorization->isAllowed('ACL RULE HERE');
                                                                        } 
                                                                }
                                                            ?>
                                                        </example>
                                                        here is example for creatre Page title  inside the page will be related to menu Item name and If I want to cahnge the name will ad new simple line will change the name for me like below
                                                        <example>
                                                           <?php
                                                            public function execute()
                                                            {
                                                                $page = $this->resultPageFactory->create();  
                                                                $page->setActiveMenu('Pulsestorm_HelloAdminBackend::a_menu_item'); >>> {{When you add this code, Magento (at the time of this writing) will do two things. The Menu Item’s top level parent (System) will be highlighted and the page’s default title will be set to second level Menu Item’s title (Other Settings).}}
                                                                return $page;
                                                            }   
                                                            this is how we change or but another name we want inside the page 
                                                                #File: app/code/Pulsestorm/HelloAdminBackend/Controller/Adminhtml/Index/Index.php    
                                                                public function execute()
                                                                {
                                                                    $page = $this->resultPageFactory->create();  
                                                                    $page->setActiveMenu('Pulsestorm_HelloAdminBackend::a_menu_item');
                                                                    $page->getConfig()->getTitle()->prepend(__('Our Custom Title')); >>> this is will be the new name of the page title
                                                                    return $page;
                                                                } 
                                                            
                                                            ?>
                                                            
                                                        </example>
                                    - Hello >>>> the file name will show up in the URl and it's peas of the action name
                                           - World.php >>>> 1- the Contrroler name 2- Deciding which page layout to use 3- Handling saving data from POST requests 4- Telling the system to render the HTTP response 5- Or redirecting users to the next/previous page
                                                           <example>
                                                               <?php
                                                                namespace Pulsestorm\HelloWorldMVVM\Controller\Hello;

                                                                use Magento\Framework\View\Result\PageFactory;
                                                                use Magento\Framework\App\Action\Context;

                                                                class World extends \Magento\Framework\App\Action\Action
                                                                {

                                                                    protected $pageFactory; >>>  // this page factory create the view I want in the front end for customer <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

                                                                    public function __construct(Context $context, PageFactory $pageFactory)
                                                                    {
                                                                        $this->pageFactory = $pageFactory;
                                                                        parent::__construct($context);
                                                                    }

                                                                    public function execute()
                                                                    {

                                                                        $page_object = $this->pageFactory->create(); >>>> this action create a new page from magento pages by pageFactory and but the content I have added inside 
                                                                        return $page_object;
                                                                    }
                                                                }
                                                                ?>
                                                            </example>
                                                            <example>
                                                                <?php
                                                                    namespace BestResponseMedia\ContactUs\Controller\Options;

                                                                    class Options extends \Magento\Framework\App\Action\Action
                                                                    {
                                                                        protected $_pageFactory;
                                                                        protected $_optionFactory;  >>> this was >> protected $_postFactory; I chnge it to fit what I made this function for

                                                                        public function __construct(
                                                                            \Magento\Framework\App\Action\Context $context,
                                                                            \Magento\Framework\View\Result\PageFactory $pageFactory,
                                                                            \BestResponseMedia\ContactUs\Model\OptionFactory $optionFactory >>> this to create the model object
                                                                        )
                                                                        {
                                                                            $this->_pageFactory = $pageFactory;
                                                                            $this->_optionFactory = $optionFactory;  >>> this was $this->_postFactory = $postFactory; >> I chnge it to fit what I made this function for
                                                                            return parent::__construct($context);
                                                                        }

                                                                        public function execute()
                                                                        {
                                                                            $option = $this->_optionFactory->create();
                                                                            $collection = $option->getCollection();
                                                                            foreach($collection as $item){
                                                                                echo "<pre>";
                                                                                print_r($item->getData());
                                                                                echo "</pre>";
                                                                            }
                                                                            exit();
                                                                            return $this->_pageFactory->create();
                                                                        }
                                                                    }?>
                                                            </example>
                        - view >>>>
                              - adminhtml >>> this file for any thing will show up in admin side
                                        - web >>>> 1- contain files will efict on admin side 
                                            - layout >>>> this file containf xml file to show us the Ui component that will direct show us what we need it to show up in the page factory 
                                                    - contactus_options_options.xml >>>> {{routename_controllerfoldername_controllername.xml}}
                                                                <example>
                                                                    <?xml version="1.0" encoding="UTF-8" ?>
                                                                        <page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
                                                                            <update handle="styles"/>
                                                                            <body>
                                                                                <referenceContainer name="content">  >>> {{Get a reference to the already created container named content, and add the cms_block_listing UI Component to it}}
                                                                                    <uiComponent name="bestresponsemedia_contactus_options_listing"/> >>> htis is the UI_component file name and this name I have create it and it's comes from 
                                                                                </referenceContainer>
                                                                            </body>
                                                                        </page>
                                                                </example>
                                            - ui_component >>>> this file contain 
                                                           - bestresponsemedia_contactus_options_listing.xml >>> {{}}
                                                                    <example>
                                                                
                                                                    </example>
                                            - foldername.js >>>> this file will make cahnges on the js for the admin side on any elemint I want
                                            
                              - frontend >>>> this file for any thing will show up in clint side or front end site
                                        - layout >>>> here we have the xml files >> this files declare the template I will create in the {view/frontend/templates/content.phtml} holding infide of him files will show us what file exactly effects on what onther file
                                                - hello_mvvm_hello_world.xml >>>> {{nameOfFront_endRoute_nameOfControllerFile_nameOfController.xml}}
                                                                            <example>
                                                                                <?xml version="1.0"?>
                                                                                    <page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" layout="1column" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">  {{layout="1column" this tage I will not use it }}
                                                                                        <referenceBlock name="content"> {{the name="content" here we define the name of file I will made in the next time for view the content }} {{ referenceBlock >> this tage contain only blocks tags that render the files whll show in the front end and it's can be changed to referenceContainer}}
                                                                                            <head>
                                                                                                <css src="css/style.css"/>
                                                                                                <script 
                                                                                                    data-main ="scripts/main" >>>>{{this attribute tells require.js to load scripts/main.js after require.js loads}}
                                                                                                    src="Pulsestorm_RequireJsTutorial/js/jsalert.js"> >>>> in this elemint we tells magento to loude the js file from this source
                                                                                                        
                                                                                                </script>
                                                                                            </head>
                                                                                               <block {{when we write }}
                                                                                                template="content.phtml" {{the name of file.phtml that located in view\frontend\templates\content.phtml }}
                                                                                                class="Pulsestorm\HelloWorldMVVM\Block\Main" {{Nameofvendor\nameofmodule\blockfilename\main.php this file contain the get and set function that will pring data from data base to render it to the front end}}
                                                                                                name="pulsestorm_helloworld_mvvm"/> {{this is a uniqe name we give it to this block to use this plck in any other place if we need that}}
                                                                                        </referenceBlock>
                                                                                    </page>  
                                                                            </example>
                                                - default.xml >>>> 
                                                
                                        - web >>>> 1- contain files will efict on frontend side
                                             - js >>>> this folder contain all of what js files I want to create 
                                                 - jsalert.js >>>> this file will make cahnges on the js for the clint side on any elemint I want {{ how to add it I should look inside view/frontend/layout/hello_mvvm_hello_world.xml up there}}
                                                                      <example>
                                                                            <script>
                                                                                  define(['jquery'], function ($) {
                                                                                        'use strict';

                                                                                        return function (checkoutData)  >> this {checkoutData} is name comes from this path {module-checkout/view/frontend/web/requirejs-config.js} and it is looks like this checkoutData:  'Magento_Checkout/js/checkout-data', so fome here we use the name have but inside as function prametar
                                                                                        {
                                                                                            const orig = checkoutData.getSelectedShippingAddress;   >> here we set the function in {const var }
                                                                                            checkoutData.getSelectedShippingAddress = function (){
                                                                                                const address = orig.bind(checkoutData)();
                                                                                                console.log('select Shipping Address', address);
                                                                                                return address;
                                                                                            }
                                                                                            return checkoutData;
                                                                                        }
                                                                                    });
                                                                             </script>
                                                                      </example>
                                             - css >>>> this folder contain all of what css files I want to create 
                                                 - foldername.css >>>> this file contain the css content
                                                 
                                        - templates >>>> here we create the phtml files that comes from {view/frontend/layout/hello_mvvm_hello_world.xml}
                                                   - content.phtml >>>> this file will content the html and any php code I want to show to the customer and this name comes from template="content.phtml" in the block file {{and here we should define the js eliments that I will effector work on inside }}
                                                                  <example>
                                                                     <div data-mage-init='{"collapsible":{}}'> >> here we use this collaps to do that whene the customer trying to click on any word of this {<h2>How about the collaps </h2>} thne this will show up {this is the collaps content right here}
                                                                         <div data-role="title">
                                                                             <h2>How about the collaps </h2>
                                                                         </div>
                                                                         <div data-role="content" style="display: none">
                                                                             this is the collaps content right here
                                                                         </div>
                                                                     </div>
                                                                      <h1 id="one" class="foo">the content will show up to the customer</h1>
                                                                                                                       {{ there is 2 types to write the function firist is the regular funtion and seocnd is jason function}}
                                                                                define(['jquery'],>>> here we define jquery to work with the js and we can add any other library to use we will define it inside the array
                                                                                 function ($) {   >>> here we try to start the function and we have define this dollar sign ($) for use it as jquery line startr
                                                                                'use strict';

                                                                                return function () {
                                                                                    console.log('yeaaaaaahhhhhh');

                                                                                }
                                                                            });

                                                                          <script type="text/x-magento-init"> >>>> here we are calling the js file 
                                                                            {
                                                                                "*" : {     >>> here we are seting the eliment we will work on 
                                                                                    "jsalert" : {   >>> here we are define the js source file and that comes from {{requirejs-config.js file}}
                                                                                                    "base_url": "<?= $block->escapeJs($block->getBaseUrl());?>  >>> here we are trying to use the php code 
                                                                                    }
                                                                                }
                                                                            }
                                                                            
                                                                            this is another example for working on another elinit
                                                                            
                                                                                {
                                                                                    "#one": {   >> her we are working on {id} of some 
                                                                                            "jsalert" :{    >>> here we have define the file route
                                                                                            "config":"value"} >>> {config : >> is function prametar that tell magento we will use this name of function for this "value">> and this value name is for "#one" >> and this is the id comes from the html code up there in the same page}
                                                                                    }
                                                                                }  


                                                                        </script>
                                                                  </example>
                                        - requirejs-config.js >>>> this file will contain the directoryes for js files inside the js files >>
                                                                   <example>
                                                                      <script>
                                                                       var config = {        >>>> here we start the configuration 
                                                                                     'mixins': {    >>>> this is object of key values -- what happen here the mixins makes me create functions and extends from functions we use this in another worled from inheritance in js 
                                                                                        'Magento_Checkout/js/checkout-data': {    >>> this is the module name I want to use it inmy module and overwrite on it or use any functions inside of it 
                                                                                            'VendorNmae/ModuleName/js/jsalert.js':true   >>> this is the file js I will create it in thais pass {{VendorNmae/ModuleName/view/frontend/web/js/jsalert.js}} and inthis file we have create it we will create oure js functions to use this Magento_Checkout
                                                                                        }
                                                                                      
                                                                                       paths:{    >>>> here we are defining the paths to our librarys I want to use or if I want to declaire a spacific path for js module 
                                                                                                'jquery.cookie' : 'Package_Module/path/to/jquery.cookie.min',
                                                                                                'nameIWant' : 'vendorName_ModuleNmae/js/thejsfile'  >>> here I define the file I want to rename it to use it inside the {.phtml} file is I want to understand more watch this video it is 5 min {https://www.mage2.tv/content/javascript/requirejs-fundamentals/rewriting-javascript-modules-with-requirejs-paths/}
                                                                                            }
                                                                          
                                                                                        shim: {  >>> this tells magento I want to run some module befor only that module I will mention below I mean my {name.js} file will run befor this one{'magento_Catalog/js/view/compair-products'} 
                                                                                            'magento_Catalog/js/view/compair-products': { >>> this is the modul I want my js file loade befor 
                                                                                                deps: ['VendorName_ModulName/js/nameofjsfileIWantItToLoadFirist'] >>> htis is my module that will loade befor the another module
                                                                                            }
                                                                                        }
                                                                          
                                                                                        deps: ['VendorName_ModulName/js/nameofjsfileIWantItToLoadFirist'] >>> indeps her I define the js file I want it to load befor any other js file but here this file will loade whene any page want to load
                                                                                            
                                                                                        map: {    >>>> here we start the mape for all js directorys 
                                                                                            '*':{    >>>> here we are will define all js files and this'*' >> mean any  requirejs file can use our 
                                                                                                jsalert:    'Pulsestorm_RequireJsTutorial/js/jsalert',,     >>>> here is we name the all directory with one name important point {whene we start to write >> Pulsestorm_RequireJsTutorial/ from here he start to look inside file name {web} this file located inside > /view/frontend/web/ and start from here we will write the path to our file like that >>  Pulsestorm_RequireJsTutorial/js/jsalert}
                                                                                            }
                                                                                        }
                                                                                    };
                                                                     </script>
                                                                   </example>
                                             
                              - base >>>> this file containf files will effect in both sides admin side and front end side {{after create any file as style or js I should un this command php bin/magento setup:static-content:deploy -f}}
                                        - web >>>> 1- contain files will efict on frontend side and admin side
                                             - directorytojsfile >>>>
                                                 - foldername.js >>>> this file will make cahnges on the js for the admin side on any elemint I want
                            
                                        
                                        - requirejs-config.js >>>> this file allowse me to add any js functions and {{Allow end-user-programmers to add require.config options to Magento’s RequireJS system , Allow end-user-programmers to perform any other setup/configuration their javascript needs}}
                        
                        - Setup >>>> this files contain the database tables {{inportant not:: this file should be done before make the first setup:upgrade for the firist time on this module}}
                               - InstallSchema.php >>>> this file makes me create the table and colums in the new table I'll creat 
                                                    <example>
                                                       <?php
                                                        namespace Mageplaza\HelloWorld\Setup;

                                                        class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
                                                        {

                                                            public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
                                                            {
                                                                $installer = $setup;
                                                                $installer->startSetup();
                                                                if (!$installer->tableExists('mageplaza_helloworld_post')) {
                                                                    $table = $installer->getConnection()->newTable(
                                                                        $installer->getTable('mageplaza_helloworld_post')
                                                                    )
                                                                        ->addColumn(
                                                                            'post_id',
                                                                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                                                            null,
                                                                            [
                                                                                'identity' => true,
                                                                                'nullable' => false,
                                                                                'primary'  => true,
                                                                                'unsigned' => true,
                                                                            ],
                                                                            'Post ID'
                                                                        )
                                                                        ->addColumn(
                                                                            'name',
                                                                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                                            255,
                                                                            ['nullable => false'],
                                                                            'Post Name'
                                                                        )
                                                                        ->addColumn(
                                                                            'url_key',
                                                                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                                            255,
                                                                            [],
                                                                            'Post URL Key'
                                                                        )
                                                                        ->addColumn(
                                                                            'post_content',
                                                                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                                            '64k',
                                                                            [],
                                                                            'Post Post Content'
                                                                        )
                                                                        ->addColumn(
                                                                            'tags',
                                                                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                                            255,
                                                                            [],
                                                                            'Post Tags'
                                                                        )
                                                                        ->addColumn(
                                                                            'status',
                                                                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                                                            1,
                                                                            [],
                                                                            'Post Status'
                                                                        )
                                                                        ->addColumn(
                                                                            'featured_image',
                                                                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                                            255,
                                                                            [],
                                                                            'Post Featured Image'
                                                                        )
                                                                        ->addColumn(
                                                                                'created_at',
                                                                                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                                                                null,
                                                                                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                                                                                'Created At'
                                                                        )->addColumn(
                                                                            'updated_at',
                                                                            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                                                            null,
                                                                            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                                                                            'Updated At')
                                                                        ->setComment('Post Table');
                                                                    $installer->getConnection()->createTable($table);

                                                                    $installer->getConnection()->addIndex(
                                                                        $installer->getTable('mageplaza_helloworld_post'),
                                                                        $setup->getIdxName(
                                                                            $installer->getTable('mageplaza_helloworld_post'),
                                                                            ['name','url_key','post_content','tags','featured_image'],
                                                                            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                                                                        ),
                                                                        ['name','url_key','post_content','tags','featured_image'],
                                                                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                                                                    );
                                                                }
                                                                $installer->endSetup();
                                                            }
                                                        }?>
                                                   </example>
                               
                               - UpgradeSchema.php >>> this file makes me overwrite this table and make changes on columns
                                                  <example>
                                                       <?php
                                                        namespace Mageplaza\HelloWorld\Setup;

                                                        use Magento\Framework\Setup\UpgradeSchemaInterface;
                                                        use Magento\Framework\Setup\SchemaSetupInterface;
                                                        use Magento\Framework\Setup\ModuleContextInterface;

                                                        class UpgradeSchema implements UpgradeSchemaInterface
                                                        {
                                                            public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
                                                                $installer = $setup;

                                                                $installer->startSetup();

                                                                if(version_compare($context->getVersion(), '1.1.0', '<')) {
                                                                    if (!$installer->tableExists('mageplaza_helloworld_post')) {
                                                                        $table = $installer->getConnection()->newTable(
                                                                            $installer->getTable('mageplaza_helloworld_post')
                                                                        )
                                                                            ->addColumn(
                                                                                'post_id',
                                                                                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                                                                null,
                                                                                [
                                                                                    'identity' => true,
                                                                                    'nullable' => false,
                                                                                    'primary'  => true,
                                                                                    'unsigned' => true,
                                                                                ],
                                                                                'Post ID'
                                                                            )
                                                                            ->addColumn(
                                                                                'name',
                                                                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                                                255,
                                                                                ['nullable => false'],
                                                                                'Post Name'
                                                                            )
                                                                            ->addColumn(
                                                                                'url_key',
                                                                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                                                255,
                                                                                [],
                                                                                'Post URL Key'
                                                                            )
                                                                            ->addColumn(
                                                                                'post_content',
                                                                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                                                '64k',
                                                                                [],
                                                                                'Post Post Content'
                                                                            )
                                                                            ->addColumn(
                                                                                'tags',
                                                                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                                                255,
                                                                                [],
                                                                                'Post Tags'
                                                                            )
                                                                            ->addColumn(
                                                                                'status',
                                                                                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                                                                1,
                                                                                [],
                                                                                'Post Status'
                                                                            )
                                                                            ->addColumn(
                                                                                'featured_image',
                                                                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                                                255,
                                                                                [],
                                                                                'Post Featured Image'
                                                                            )
                                                                            ->addColumn(
                                                                                'created_at',
                                                                                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                                                                null,
                                                                                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                                                                                'Created At'
                                                                            )->addColumn(
                                                                                'updated_at',
                                                                                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                                                                null,
                                                                                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                                                                                'Updated At')
                                                                            ->setComment('Post Table');
                                                                        $installer->getConnection()->createTable($table);

                                                                        $installer->getConnection()->addIndex(
                                                                            $installer->getTable('mageplaza_helloworld_post'),
                                                                            $setup->getIdxName(
                                                                                $installer->getTable('mageplaza_helloworld_post'),
                                                                                ['name','url_key','post_content','tags','featured_image'],
                                                                                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                                                                            ),
                                                                            ['name','url_key','post_content','tags','featured_image'],
                                                                            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                                                                        );
                                                                    }
                                                                }

                                                                $installer->endSetup();
                                                            }
                                                        }?>
                                                   </example>
                                                   
                               - InstallData >>>>    this file is for insetr data to the table I have create it before 
                                                <example>
                                                    <?php
                                                            namespace Mastering\SampleModule\Setup;


                                                            use Magento\Framework\Setup\InstallDataInterface;
                                                            use Magento\Framework\Setup\ModuleContextInterface;
                                                            use Magento\Framework\Setup\ModuleDataSetupInterface;

                                                            /**
                                                             * Class InstallData
                                                             * @package Mastering\SampleModule\Setup
                                                             */
                                                            class InstallData implements InstallDataInterface
                                                            {

                                                                /**
                                                                 * @param ModuleDataSetupInterface $setup
                                                                 * @param ModuleContextInterface $context
                                                                 */
                                                                public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
                                                                {
                                                                    $setup->startSetup();

                                                                    $setup->getConnection()->insert(
                                                                        $setup->getTable('mastering_sample_item'),
                                                                        [
                                                                        'name' => 'Item 1'
                                                                        ]
                                                                    );

                                                                    $setup->getConnection()->insert(
                                                                        $setup->getTable('mastering_sample_item'),
                                                                        [
                                                                            'name' => 'Item 2'
                                                                        ]
                                                                    );

                                                                    $setup->endSetup();
                                                                }
                                                            }
                                                    ?>
                                                </example>
                               - UpgradeData >>>>    this file for ugrade the data that I want to insert into the field for spacific field if I create new coulumd and I want to fell it 
                                                <example>
                                                    <?php
                                                                        namespace Mastering\SampleModule\Setup;


                                                                        use Magento\Framework\Setup\ModuleContextInterface;
                                                                        use Magento\Framework\Setup\ModuleDataSetupInterface;
                                                                        use Magento\Framework\Setup\UpgradeDataInterface;

                                                                        /**
                                                                         * Class UpgradeData
                                                                         * @package Mastering\SampleModule\Setup
                                                                         */
                                                                        class UpgradeData implements UpgradeDataInterface
                                                                        {
                                                                            /**
                                                                             * @param ModuleDataSetupInterface $setup
                                                                             * @param ModuleContextInterface $context
                                                                             */
                                                                            public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
                                                                            {
                                                                                $setup->startSetup();

                                                                                if (version_compare($context->getVersion(), '1.0.1', '<')){

                                                                                    $setup->getConnection()->update(
                                                                                        $setup->getTable('mastering_sample_item'),
                                                                                        [
                                                                                            'description'=> ' default Description',
                                                                                        ],
                                                                                        $setup->getConnection()->quoteInto('id', 1)
                                                                                    );
                                                                                }


                                                                                $setup->endSetup();

                                                                            }
                                                                        }
                                                    ?>
                                                </example>
                                                  
                        - Model >>>> we start to create this file to creat files will bring data from database 
                                - ResourceModel >>>> this files contain 
                                                - Options >>>> file path for my colection file
                                                      - Collection.php >>> this file to define {{Model/ResourceModel/Options.php}} and {{Model/Option.php}} and return them and this file do the model and resource model worke it's accept to prametars
                                                                          <example>
                                                                              <?php
                                                                                namespace BestResponseMedia\ContactUs\Model\ResourceModel\Options;

                                                                                use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

                                                                                class Collection extends AbstractCollection
                                                                                {
                                                                                    protected $_idFieldName = 'option_id';  >>> here we define the item Id  from the table
                                                                                    protected $_eventPrefix = 'bestresponsemedia_contactus_options_collection';
                                                                                    protected $_eventObject = 'options_collection';

                                                                                    protected function _construct() >>> here I define the option model and ResourceModel 
                                                                                    {
                                                                                        $this->_init('BestResponseMedia\ContactUs\Model\Option','BestResponseMedia\ConatactUs\Model\ResourceModel\Options');
                                                                                }?>
                                                                          </example>
                                                - Options.php >>> this file to define the table name and primary key for that table
                                                            <example>
                                                                <?php
                                                                    namespace BestResponseMedia\ContactUs\Model\ResourceModel;

                                                                    use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;  >>> this function contain the functions for fetching information from database
                                                                    use \Magento\Framework\Model\ResourceModel\Db\Context;

                                                                    class Options extends AbstractDb >>> this function contain the functions for fetching information from database
                                                                    {
                                                                        public function __construct(Context $context)   >>> This method will call _init  
                                                                        {
                                                                            parent::__construct($context);
                                                                        }

                                                                        protected function _construct() >>> This method will call _init 
                                                                        {
                                                                            $this->_init('bestresponsemedia_contactus_options','option_id');  >>> function to define the table name and primary key for that table
                                                                        }
                                                                    }?>
                                                            </example>
                                - Option.php >>> this file will return us to the resource model with unique id for the model
                                            <example>
                                                <?php
                                                    namespace BestResponseMedia\ContactUs\Model;


                                                    class Option extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
                                                    {
                                                        const CACHE_TAG = 'bestresponsemedia_contactus_options';
                                                        protected $_cacheTag = 'bestresponsemedia_contactus_options'; >>> a unique identifier for use within caching neex nore explanation
                                                        protected $_eventPrefix = 'bestresponsemedia_contactus_options'; >>> a prefix for events to be triggered

                                                        protected function _construct()
                                                        {
                                                            $this->_init('BestResponseMedia\ContactUs\Model\ResourceModel\Options'); >>> will define the resource model which will actually fetch the information from the database
                                                        }

                                                        public function getIdentities()     >>> method which will return a unique id for the model
                                                        {
                                                            return [self::CACHE_TAG . '_' . $this->getId()];
                                                        }

                                                        public function getDefaultValues()
                                                        {
                                                            $values = [];
                                                            return $values;
                                                        }
                                                    }?>

                                            </example>
                        - Plugin >>>> here we start to create the plugin
                                - ExamplePlugin.php >>>> this is the plugin file will contain all codes we will use
                                                    <example>
                                                        <?php
                                                            namespace Pulsestorm\PluginExample\Plugin;

                                                            use Magento\Catalog\Api\ProductRepositoryInterface;
                                                            use Psr\Log\LoggerInterface;

                                                            class ProductRepositoryExamplePlugin
                                                            {
                                                                private $logger;
                                                                public function __construct(LoggerInterface $logger)    
                                                                {
                                                                    $this->logger = $logger;    >> here we use this logger class to test where is my plugin loadge
                                                                }

                                                                public function beforeGetById(  >> {befor} is the method from my plugin I have create and {GetById} is method from {Magento\Catalog\Api\ProductRepositoryInterface}

                                                                    ProductRepositoryInterface $subject,
                                                                    $productId,
                                                                    $editMode = false,
                                                                    $storeId = null,
                                                                    $forceReload = false
                                                                )
                                                                {
                                                                    $this->logger->info('before get product by id ', $productId); >> to pring the message inside the logger file
                                                                    return [$productId,$editMode,$storeId,$forceReload];
                                                                }
                                                            }
                                                                                    
                                                                                    
                                                                public function aroundOriginalMethod(
                                                                    ProductRepositoryInterface $subject,>> to recive the orignal arguments
                                                                    callable $proceed,>> will call the orignal method or the next on the execution >> the {around} method is responsepl for calling proceed method for passing any original argument and the around method
                                                                    $productId,
                                                                    $editMode = false,
                                                                    $storeId = null,
                                                                    $forceReload = false
                                                                ){
                                                                    $this->logger->info('around before get product ID' . $productId); >> to pring the message inside the logger file
                                                                    $result = $proceed($productId,$editMode,$storeId,$forceReload);
                                                                    return $result;
                                                                }
                                                        ?>
                                                    </example>
                        -
                        -
                        - pub >>>> this file contain and include css and js files for front end related to magento 2 user interface and make it work throw special methods 
                        -
                        - registration.php >> - to defin the name and were is that module in magento and declare the path of this module to magento
                        
                       
                    
                 
    ----------------------------------------------------------------------------
              
              
              
              
              
              
              
              
              <?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/** @var \Magento\Customer\Block\Form\Register $block */
?>
<?= $block->getChildHtml('form_fields_before') ?>
<?php /* Extensions placeholder */ ?>
<?= $block->getChildHtml('customer.form.register.extra') ?>
<form class="form create account form-create-account" action="<?= $block->escapeUrl($block->getPostActionUrl()) ?>" method="post" id="form-validate" enctype="multipart/form-data" autocomplete="off">
    <?= /* @noEscape */ $block->getBlockHtml('formkey'); ?>
    <fieldset class="fieldset create info">
        <legend class="legend"><span><?= $block->escapeHtml(__('Personal Information')) ?></span></legend><br>
        <input type="hidden" name="success_url" value="<?= $block->escapeUrl($block->getSuccessUrl()) ?>">
        <input type="hidden" name="error_url" value="<?= $block->escapeUrl($block->getErrorUrl()) ?>">
        <?= $block->getLayout()->createBlock(\Magento\Customer\Block\Widget\Name::class)->setObject($block->getFormData())->setForceUseCustomerAttributes(true)->toHtml() ?>
        <?php if ($block->isNewsletterEnabled()) : ?>
            <div class="field choice newsletter">
                <input type="checkbox" name="is_subscribed" title="<?= $block->escapeHtmlAttr(__('Sign Up for Newsletter')) ?>" value="1" id="is_subscribed"<?php if ($block->getFormData()->getIsSubscribed()) : ?> checked="checked"<?php endif; ?> class="checkbox">
                <label for="is_subscribed" class="label"><span><?= $block->escapeHtml(__('Sign Up for Newsletter')) ?></span></label>
            </div>
            <?php /* Extensions placeholder */ ?>
            <?= $block->getChildHtml('customer.form.register.newsletter') ?>
        <?php endif ?>

        <?php $_dob = $block->getLayout()->createBlock(\Magento\Customer\Block\Widget\Dob::class) ?>
        <?php if ($_dob->isEnabled()) : ?>
            <?= $_dob->setDate($block->getFormData()->getDob())->toHtml() ?>
        <?php endif ?>

        <?php $_taxvat = $block->getLayout()->createBlock(\Magento\Customer\Block\Widget\Taxvat::class) ?>
        <?php if ($_taxvat->isEnabled()) : ?>
            <?= $_taxvat->setTaxvat($block->getFormData()->getTaxvat())->toHtml() ?>
        <?php endif ?>

        <?php $_gender = $block->getLayout()->createBlock(\Magento\Customer\Block\Widget\Gender::class) ?>
        <?php if ($_gender->isEnabled()) : ?>
            <?= $_gender->setGender($block->getFormData()->getGender())->toHtml() ?>
        <?php endif ?>
    </fieldset>
    <?php if ($block->getShowAddressFields()) : ?>
        <fieldset class="fieldset address">
            <legend class="legend"><span><?= $block->escapeHtml(__('Address Information')) ?></span></legend><br>
            <input type="hidden" name="create_address" value="1" />

            <?php $_company = $block->getLayout()->createBlock(\Magento\Customer\Block\Widget\Company::class) ?>
            <?php if ($_company->isEnabled()) : ?>
                <?= $_company->setCompany($block->getFormData()->getCompany())->toHtml() ?>
            <?php endif ?>

            <?php $_telephone = $block->getLayout()->createBlock(\Magento\Customer\Block\Widget\Telephone::class) ?>
            <?php if ($_telephone->isEnabled()) : ?>
                <?= $_telephone->setTelephone($block->getFormData()->getTelephone())->toHtml() ?>
            <?php endif ?>

            <?php $_fax = $block->getLayout()->createBlock(\Magento\Customer\Block\Widget\Fax::class) ?>
            <?php if ($_fax->isEnabled()) : ?>
                <?= $_fax->setFax($block->getFormData()->getFax())->toHtml() ?>
            <?php endif ?>

            <?php $_streetValidationClass = $this->helper(\Magento\Customer\Helper\Address::class)->getAttributeValidationClass('street'); ?>

            <div class="field street required">
                <label for="street_1" class="label"><span><?= /* @noEscape */ $block->getAttributeData()->getFrontendLabel('street') ?></span></label>
                <div class="control">
                    <input type="text" name="street[]" value="<?= $block->escapeHtmlAttr($block->getFormData()->getStreet(0)) ?>" title="<?= /* @noEscape */ $block->getAttributeData()->getFrontendLabel('street') ?>" id="street_1" class="input-text <?= $block->escapeHtmlAttr($_streetValidationClass) ?>">
                    <div class="nested">
                        <?php $_streetValidationClass = trim(str_replace('required-entry', '', $_streetValidationClass)); ?>
                        <?php for ($_i = 2, $_n = $this->helper(\Magento\Customer\Helper\Address::class)->getStreetLines(); $_i <= $_n; $_i++) : ?>
                            <div class="field additional">
                                <label class="label" for="street_<?= /* @noEscape */ $_i ?>">
                                    <span><?= $block->escapeHtml(__('Address')) ?></span>
                                </label>
                                <div class="control">
                                    <input type="text" name="street[]" value="<?= $block->escapeHtml($block->getFormData()->getStreetLine($_i - 1)) ?>" title="<?= $block->escapeHtmlAttr(__('Street Address %1', $_i)) ?>" id="street_<?= /* @noEscape */ $_i ?>" class="input-text <?= $block->escapeHtmlAttr($_streetValidationClass) ?>">
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <div class="field required">
                <label for="city" class="label"><span><?= /* @noEscape */ $block->getAttributeData()->getFrontendLabel('city') ?></span></label>
                <div class="control">
                    <input type="text" name="city" value="<?= $block->escapeHtmlAttr($block->getFormData()->getCity()) ?>" title="<?= /* @noEscape */ $block->getAttributeData()->getFrontendLabel('city') ?>" class="input-text <?= $block->escapeHtmlAttr($this->helper(\Magento\Customer\Helper\Address::class)->getAttributeValidationClass('city')) ?>" id="city">
                </div>
            </div>

            <div class="field region required">
                <label for="region_id" class="label"><span><?= /* @noEscape */ $block->getAttributeData()->getFrontendLabel('region') ?></span></label>
                <div class="control">
                    <select id="region_id" name="region_id" title="<?= /* @noEscape */ $block->getAttributeData()->getFrontendLabel('region') ?>" class="validate-select region_id" style="display:none;">
                        <option value=""><?= $block->escapeHtml(__('Please select a region, state or province.')) ?></option>
                    </select>
                    <input type="text" id="region" name="region" value="<?= $block->escapeHtml($block->getRegion()) ?>" title="<?= /* @noEscape */ $block->getAttributeData()->getFrontendLabel('region') ?>" class="input-text <?= $block->escapeHtmlAttr($this->helper(\Magento\Customer\Helper\Address::class)->getAttributeValidationClass('region')) ?>" style="display:none;">
                </div>
            </div>

            <div class="field zip required">
                <label for="zip" class="label"><span><?= /* @noEscape */ $block->getAttributeData()->getFrontendLabel('postcode') ?></span></label>
                <div class="control">
                    <input type="text" name="postcode" value="<?= $block->escapeHtmlAttr($block->getFormData()->getPostcode()) ?>" title="<?= /* @noEscape */ $block->getAttributeData()->getFrontendLabel('postcode') ?>" id="zip" class="input-text validate-zip-international <?= $block->escapeHtmlAttr($this->helper(\Magento\Customer\Helper\Address::class)->getAttributeValidationClass('postcode')) ?>">
                </div>
            </div>

            <div class="field country required">
                <label for="country" class="label"><span><?= /* @noEscape */ $block->getAttributeData()->getFrontendLabel('country_id') ?></span></label>
                <div class="control">
                    <?= $block->getCountryHtmlSelect() ?>
                </div>
            </div>
            <?php $addressAttributes = $block->getChildBlock('customer_form_address_user_attributes');?>
            <?php if ($addressAttributes) : ?>
                <?php $addressAttributes->setEntityType('customer_address'); ?>
                <?php $addressAttributes->setFieldIdFormat('address:%1$s')->setFieldNameFormat('address[%1$s]');?>
                <?php $block->restoreSessionData($addressAttributes->getMetadataForm(), 'address');?>
                <?= $addressAttributes->setShowContainer(false)->toHtml() ?>
            <?php endif;?>
            <input type="hidden" name="default_billing" value="1">
            <input type="hidden" name="default_shipping" value="1">
        </fieldset>

    <?php endif; ?>
    <fieldset class="fieldset create account" data-hasrequired="<?= $block->escapeHtmlAttr(__('* Required Fields')) ?>">
        <legend class="legend"><span><?= $block->escapeHtml(__('Sign-in Information')) ?></span></legend><br>
        <div class="field required">
            <label for="email_address" class="label"><span><?= $block->escapeHtml(__('Email')) ?></span></label>
            <div class="control">
                <input type="email" name="email" autocomplete="email" id="email_address" value="<?= $block->escapeHtmlAttr($block->getFormData()->getEmail()) ?>" title="<?= $block->escapeHtmlAttr(__('Email')) ?>" class="input-text" data-mage-init='{"mage/trim-input":{}}' data-validate="{required:true, 'validate-email':true}">
            </div>
        </div>
        <div class="field password required">
            <label for="password" class="label"><span><?= $block->escapeHtml(__('Password')) ?></span></label>
            <div class="control">
                <input type="password" name="password" id="password"
                       title="<?= $block->escapeHtmlAttr(__('Password')) ?>"
                       class="input-text"
                       data-password-min-length="<?= $block->escapeHtmlAttr($block->getMinimumPasswordLength()) ?>"
                       data-password-min-character-sets="<?= $block->escapeHtmlAttr($block->getRequiredCharacterClassesNumber()) ?>"
                       data-validate="{required:true, 'validate-customer-password':true}"
                       autocomplete="off">
                <div id="password-strength-meter-container" data-role="password-strength-meter" aria-live="polite">
                    <div id="password-strength-meter" class="password-strength-meter">
                        <?= $block->escapeHtml(__('Password Strength')) ?>:
                        <span id="password-strength-meter-label" data-role="password-strength-meter-label">
                            <?= $block->escapeHtml(__('No Password')) ?>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <div class="field confirmation required">
            <label for="password-confirmation" class="label"><span><?= $block->escapeHtml(__('Confirm Password')) ?></span></label>
            <div class="control">
                <input type="password" name="password_confirmation" title="<?= $block->escapeHtmlAttr(__('Confirm Password')) ?>" id="password-confirmation" class="input-text" data-validate="{required:true, equalTo:'#password'}" autocomplete="off">
            </div>
        </div>
        <?= $block->getChildHtml('form_additional_info') ?>
    </fieldset>
    <div class="actions-toolbar">
        <div class="primary">
            <button type="submit" class="action submit primary" title="<?= $block->escapeHtmlAttr(__('Create an Account')) ?>"><span><?= $block->escapeHtml(__('Create an Account')) ?></span></button>
        </div>
        <div class="secondary">
            <a class="action back" href="<?= $block->escapeUrl($block->getBackUrl()) ?>"><span><?= $block->escapeHtml(__('Back')) ?></span></a>
        </div>
    </div>
</form>
<script>
require([
    'jquery',
    'mage/mage'
], function($){

    var dataForm = $('#form-validate');
    var ignore = <?= /* @noEscape */ $_dob->isEnabled() ? '\'input[id$="full"]\'' : 'null' ?>;

    dataForm.mage('validation', {
    <?php if ($_dob->isEnabled()) : ?>
        errorPlacement: function(error, element) {
            if (element.prop('id').search('full') !== -1) {
                var dobElement = $(element).parents('.customer-dob'),
                    errorClass = error.prop('class');
                error.insertAfter(element.parent());
                dobElement.find('.validate-custom').addClass(errorClass)
                    .after('<div class="' + errorClass + '"></div>');
            }
            else {
                error.insertAfter(element);
            }
        },
        ignore: ':hidden:not(' + ignore + ')'
    <?php else : ?>
        ignore: ignore ? ':hidden:not(' + ignore + ')' : ':hidden'
    <?php endif ?>
    }).find('input:text').attr('autocomplete', 'off');

});
</script>
<?php if ($block->getShowAddressFields()) : ?>
<script type="text/x-magento-init">
    {
        "#country": {
            "regionUpdater": {
                "optionalRegionAllowed": <?= /* @noEscape */ $block->getConfig('general/region/display_all') ? 'true' : 'false' ?>,
                "regionListId": "#region_id",
                "regionInputId": "#region",
                "postcodeId": "#zip",
                "form": "#form-validate",
                "regionJson": <?= /* @noEscape */ $this->helper(\Magento\Directory\Helper\Data::class)->getRegionJson() ?>,
                "defaultRegion": "<?= (int) $block->getFormData()->getRegionId() ?>",
                "countriesWithOptionalZip": <?= /* @noEscape */ $this->helper(\Magento\Directory\Helper\Data::class)->getCountriesWithOptionalZip(true) ?>
            }
        }
    }
</script>
<?php endif; ?>

<script type="text/x-magento-init">
    {
        ".field.password": {
            "passwordStrengthIndicator": {
                "formSelector": "form.form-create-account"
            }
        }
    }
</script>

               