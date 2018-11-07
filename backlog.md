- [ ] Implement the 'item' table:

```
id
itemType (eg. 'plant', 'mineral', 'weapon')
typeId (the type is where we'll store the type specific properties. For example plants will have things like hunger values, poison, isDye, stored on them, and weapons will have attack & defence values on them, and so on. So we don't have to store a million irrelevent traits for every item.)
name (eg. 'fruit', 'wood', 'leaf', 'flower')
unitWeight
unitVolume
rotRate
description {{a long string with all kinds of age/quality/color/etc modifiers in here!}}
```

- [ ] Implement the character_item table:

```
characterId
itemId
count
age
quality
```

- [ ] Add things like hunger values to the current plant generator code
- [ ] Start adding/removing to the character_item table when, eg, a user forages some fruit!
   - Plant is found, we know what the user wants to forage, so then we get the items from the plantId (i guess using a where typeId === plantId && itemType === 'leaf', if the user wants to gather the leaves. And so on.)
   - Then, we transfer these items to a user's inventory (if possible. For now we assume it is.) So this means, we create a row in the character_item table if one doesn't already exist with this characterId and itemId, and init its values.
   - From now on we should be able to get a character's inventory by searching the character_item table :)

- [ ] Implement the locationZones logic so that we can...
- [ ] Start adding/removing to a location_item table (?) if the character items is full!
