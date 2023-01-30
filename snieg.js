const createSnow = () =>{
  const snowflake = document.createElement('i')
  snowflake.classList.add('snowflake')
  snowflake.textContent='❄'

  snowflake.style.left = Math.random()* window.innerWidth +'px'
  snowflake.style.animationDuration = Math.random()* 5+2+'s'
  snowflake.style.opacity = Math.random()

  document.body.append(snowflake)

  setTimeout(()=>{
    snowflake.remove()
  }, 5000)
}

createSnow()
setInterval(createSnow,80) 

