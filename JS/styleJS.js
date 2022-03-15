function menuburger(){
    const y = document.getElementById("menu");
    if (y.style.display === "block") {
      y.style.display = "none";
      console.log("la c'est cense mettre none");
    } else {
      y.style.display = "block";
      console.log("la c'est cense mettre block");
    }
}
