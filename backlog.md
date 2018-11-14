- [x] Okay next on the list comes travelling! 
- [x] So we get a list of bordering zones and locations
    + Zones of the same layer (ie zones with the same parentZone)
    + Parent zone
    + if zone is layer 0, also bordering locations.
- [ ] Add character validation on zones endpoint so you can't just get the whole map :P
- [ ] User can then send the id of the zone or location they want to travel to
- [ ] If they want to travel to a location, we must find the outer zone there and turn up somewhere in that
- [ ] Travelling takes some amount of time, and generates some kind of a message. It must be none blocking. 'You begin travelling', 'You end travelling' - and on you end, your zone has changed. Your visibility to people in your zone will change though unless they are in your travel group, but that's just normal.