#Main Features:
	- Uses Yii2 Advanced Template to separate the frontend from the backend functionality
	
##Backend:
	Is where the library is administered

##Frontend:
	Is the public-facing part of the application that will be used by members

####App specific:
  - Currently, a book can have only one author and category

####Areas of Improvement:
- Caching 
- i18n
- Search 
- Allowing Multiple authors and categories for a book
- Email functionality


##Installation:
  - Clone the app in a web-accessible folder
  - Create a MySQL database and name it dl_yii2
  - Open the command prompt and change to the installation folder
      - Run 'composer install' to install all the dependencies
      - Run 'init' to choose the environment (Development or Production)
      - Run 'yii migrate' to create the tables
  - Open the site in a browser

###NOTE:
  - The app comes with three preconfigured roles:
    - librarian (Omnipotent role)
    - assistant_librarian(less powerful than librarian)
    - member (users of the system will belong to this role)

  - The app comes with two preconfigured admin users:
    1. name: adminuser/ password: password
      - Belongs to the 'librarian' role

    2. asstadmin/password
      - Belongs to the 'assistant_librarian' role
