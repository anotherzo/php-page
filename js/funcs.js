function confirmDelete() {
  var agree=confirm("Sind Sie sicher, dass dieses Objekt gelöscht werden soll? Diese Entscheidung kann nicht rückgängig gemacht werden!");
  if(agree) {
    return true;
  } else {
    return false;
  }
}
