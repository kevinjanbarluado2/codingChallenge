# Kevin Jan Barluado Coding Challenge
 
First you must create and configure .env file by duplicating .env.example
Then, you must import the codingchallenge.sql in your mysql which is located inside this folder.

You can set the Winning Moment by posting to the rest API w/ the key of 'value' and your assigned value in a format of timestamp
at this url /entrant/winning-moment

You can set the chance by posting to the rest API w/ the key of 'value' and your assigned value in a format of integer
at this url /entrant/chance

Database Strcuture:
entrant_table
*id
*name
*email
*mechanics
*timestamp
*win (boolean)

mechanics_table
*id
*type -> (winning_moment and chance)
*value
