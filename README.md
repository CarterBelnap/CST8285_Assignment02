Search Filter

- Write some JS to filter the list of all ideas by string that the user inserts in the search bar

Genre Filter

- Similarly to the search filter, we are going to write some JS (including an array of all genres in our database) in order to then get a string that we can compare to the populated ideas

Viewing Ideas

- We need to be able to click on the "view" button underneath each idea and be able to see all info regarding that idea
- To do that, we can start by using our "List_Ideas.php" to have a button with a "get" method, said get method will be passed to "View_Idea.php" where we will have an SQL command to pull and join all relative data regarding that individual idea, then ideally we display and overwrite that data in the same container as "List_Ideas.php". This can include things like, title, images, any section info, and even comments from other users

JS Form validation

- Regarding login, fix the form validation

CSS Styling/General Comments

- Finally we will adjust and fine-tune some CSS styling on all of our pages, and also add comment to our pages which give further explanation to their contents
