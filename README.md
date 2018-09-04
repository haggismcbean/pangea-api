`php artisan serve` or `php artisan serve --port=8080`

### Db structure (TODO)


One user many Characters

One character one location node

One location node one town

One town many buildings

One town many characters

One town many groups

One group many speeches

One character many items

One building many items

SentenceFormer
 - When a player joins his private webhook, the sentence former gets events from the sentence queue and decides whether to form sentences from them. If it decides to, then it emits them. It gets all the sentences and checks for priority FIRST in case a super urgent event happens like a sec before the player logged in (so they can react to it instead of reading about birds chirupping first)

 - Whilst a player is online, the sentence former is called each time a sentence is pushed to the queue automatically and everything works as you'd expect.

 - A player logging in also counts as an event that would create sentences - as the user gets updated about the world they've woken up in.

 - Some sentences will start with verbose, then be downgraded to standard, then be downgraded to terse, based on their priority and other event priorities.


Sentence Queue
 - When anything happens in the game, we add an event to the player's sentence queue so that users can be informed about that event. Events are pushed with a priority and then game logic can decide if they want to read about it or not. But basically we have a dumping ground for each player where we drop anything that they can see hear or feel and then the sentenceFormer decides whether to actually pass the information on or not. We write all to DB AND pass it to a class, so it's available if user logs off and whatnot.
