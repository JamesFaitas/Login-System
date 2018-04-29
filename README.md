# Login System
#Access link: lamp0.cs.stir.ac.uk/~dfa/login

A web page is that offers users the opportunity to either log in with existing credentials or register to create an account. Log in credentials involve an email address (which serves as a username) and a password. When users register they are prompted to enter an email address and choose their own password, which must have 8 characters or more, including at least one number and one letter. Any other characters are not allowed. 

When a new user joins, the system checks whether their email address is already in use and, if it is, it doesn't allow them to create a new account. It also checks that the email address provided has a valid format. The password is validated at both the client and the server and users are warned if they enter an email address that is already in use before they submit the form. 

Users are also offered a facility that sends them a new password if they have forgotten theirs if they provide their email address. Once a user is logged in, the system allows them to view other pages that are only accessible following a recent login. These pages consist of a welcome page and a facility to change the user password is also provided. All data and user information is stored in a MySQL database. Passwords are encrypted and the forgot password facility works by utilizing tokens.

Further to the login system, a report describing the system and its architecture is provided.
