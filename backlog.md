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