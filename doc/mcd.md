# Lettuce seed

## MCD

### user => plant 0,n 
Un user peut n'avoir aucune plante enregistrée, ou en avoir autant qu'il veut.

### plant => user 1,1
Une plante est forcément postée par un utilisateur et n'appartient pas à d'autres. 
___

### CONTAINS : plant => picture 0,n
Une plante peut ne pas être encore documentée (0 photo), ou avoir une infinité de photos.

### picture => plant 1,n
Une photo est rattachée à une plante au minimum, mais peut aussi être rattachée à plusieurs (au cas où plusieurs plantes soient sur la même photo). 

__

### IS COVER : plant => picture  0,1
Une plante n'a qu'une seule photo qui lui sert de couverture (mais peut très bien ne pas en avoir)

### picture => plant 0,n
Une photo peut n'être la couverture d'aucun dossier, mais peut être en cover de plusieurs (étant donné qu'elle peut représenter plusieurs plantes).