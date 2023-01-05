# Movie App
This is a simple web app to display all the movies from the TMDB API.<br>
It's created with the scope of learning the MVC pattern.<br>

## Features
- Display movies ordered by different filters (popular, now playing, top rated, upcoming);
- Search for movies by title;
- Display specific movie details;
- Loading all the cast with jQuery AJAX;
- Basic pagination system;
- Basic user signup/login;
- Add/remove a movie to/from own watchlist;
- Display user watchlist on his profile page;
- Change the website language.

## How to setup
- Clone this repository to your website root folder;
- Import the database tables with the database.sql file in /app/config/ into your database;
- Rename the .env.example to .env in /app/config/ and insert all your private data;
- Use "composer install" to install all dependencies;
- This app is also made with the [ciro23/mvc-framework](https://github.com/Ciro23/mvc-framework) library, visit the repository page to understand how it works.
