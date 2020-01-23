# Lisa Angel Contact Form

Hey there. I've commented the vast majority of the code to give a run down of each any every function here and there, and what it's been coded to do, so I won't go into that in here.

In a nutshell the form consists of:
* A HTML file with the page structure and form itself
* CSS (obviously for styling)
* jQuery (for the below)
* A JS file with all my functions, including an Ajax call which posts to...
* A PHP file with server side validation in, which sends a response back to the view
* Needed assets (images, fonts, etc)

Forgot to mention on the CV that I could do Ajax, but that's my usual go to for updating a view. I chose this as I like the user experience of not reloading the page (or being linked to a seperate one). With the small amounts of data being passed around I felt this was entirely suitable for the task. As for JavaScript functions, I use jQuery entirely. It's something I'm completely familiar with and makes JavaScript much nicer to read/code.

As for the design. I kept it very simple and in line with your current website (colours, fonts, etc), to keep the Lisa Angel branding consistent. I wasn't sure if this was aimed to be a contact form on the site, or it's own portal sort of thing. If it was part of the site, headers and footers would obviously be included in there.

As mentioned within the comments of the PHP file that the Ajax request posts to (ajax/contact.php), moving forward with this I would create a database which would get populated with the enquiries. From there a support portl could be made where Lisa Angel employees could log in and update/respond to tickets. I feel like this would be a nice way to manage support requests instead of pinging emails backwards and forwards. It could allow for easy searching of support tickets, and allow you to easily see the history of responses.

In that same file, I also included some sanitisation of the field to try to best avoid SQL Injection. I researched a bit into this and found that the general consensus is that using PDO is the best way to do this. I researched a bit into it, but I feel like with one evenings experience in the subject that I wasn't 100% comfortable including it within the code. I will research this subject further.

A lot of the functions in the file (Inserting into the database etc) aren't actually run as I don't have a database set up at the moment, but I thought I would include it anyway to try explain how I would execute the task in a production environment.

I think that about covers it all (I hope!). If you have any questions regarding anything I forgot to mention, please don't hesitate to drop me an email.

Danny.
