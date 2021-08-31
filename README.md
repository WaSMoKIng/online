# online

/scoreboard objectives add online dummy online

/scoreboard players set @a online 0 

/execute @e[type=player] ~~~ scoreboard players add online online 1

 /execute @a ~~~ titleraw @s actionbar{"rawtext":[{"translate":"online §f: "},{"score":{"name":"@s","player":"online"}},{"translate":"/10"}]}
