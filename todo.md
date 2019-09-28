todo.md

BEFORE MAKING NEW FEATURES, LETS STOP TO FIX THINGS

Broken things audit:

 - Give item - only shown myself in the list of people to give it to...
 - Work on activity throws error
 - undefined has woken up (should be 'unknown')... Also notification is shown twice somehow :)
 - the text enterer needs to be way fancier, or changed to be a normal input:
 	- handle special characters like 'tab'
 	- handle ctrl + backspace
 	- handle arrows
 	- handle ctrl + arrows
 	- handle ctrl + v
 	- handle things like click and drag
 - animations (red on combat, etc)
 - cancel the welcome messages when a user does something
 - the five minute messages should be more randomised (messages AND timing)
 	- alternatively have a randomised one minute message that goes out to people who haven't had anything in a while sometimes.



SOMEHOW RELATED TO INCOGNITO MODE??
 - 'Plus 0 people' - then click show and two people are there (also both are supposed to be online)
 - Presence web socket (hard)



SOLIDIFYING CURRENT OFFERING

- History
	- when you name someone, we should see the new name

- Dead people (showing, looting, burying)

- Inventory stuff (?)

- Click on character name to go to character's inventory panel.




BUGS:
- Fix timestamps (fe and be generated times need to match :P)
- Don't automatically try to sign up to chat in a wilderness (so i get rid of the error messages)
- Click on actions in people panel shouldn't open the user's description
- I keep dying? "You vision fades. You sit down where you stood and realise you don't feel cold any more. A shadow crosses. A veil lifts. All things die."
- Reload zones on sharer's account when location tab opened.




BIG DEALS:

Tech Tree (implement item uses)
		  (try making them just to make sure all is cool)

Attack a person
 - improve combat

Embarkation

Animals (farming)
		(pastoral)
		(horses)

AND THEN (AFTER LAUNCH?):

Boats

Roads

Money

Stealing off people

- Deleting unused empty zones with no child zones
	- cron job
	- feels like it can come later to be honest mate.
