//the JS for the wheel. I did my math homework. 

const sectors = [
    { color: '#F6851E', label: '1' },
    { color: '#733B97', label: '2' },
    { color: '#8EC63F', label: '3' },
    { color: '#F6851E', label: '4' },
    { color: '#733B97', label: '5' },
    { color: '#8EC63F', label: '6' }
  ]
  
  const rand = (m, M) => Math.random() * (M - m) + m
  const tot = sectors.length
  const spinEl = document.querySelector('#spin')
  const ctx = document.querySelector('#wheel').getContext('2d')
  const dia = ctx.canvas.width
  const rad = dia / 2
  const PI = Math.PI
  const TAU = 2 * PI
  const arc = TAU / sectors.length
  
  const friction = 0.991 // 0.995=soft, 0.99=mid, 0.98=hard idk what I'm doing but I spent too much time on this
  let angVel = 0 // Angular velocity
  let ang = 0 // Angle in radians
  
  const getIndex = () => Math.floor(tot - (ang / TAU) * tot) % tot
  
  function drawSector(sector, i) {
    const ang = arc * i
    ctx.save()
    // Color transition (help)
    ctx.beginPath()
    ctx.fillStyle = sector.color
    ctx.moveTo(rad, rad)
    ctx.arc(rad, rad, rad, ang, ang + arc)
    ctx.lineTo(rad, rad)
    ctx.fill()
    // Text in center
    ctx.translate(rad, rad)
    ctx.rotate(ang + arc / 2)
    ctx.textAlign = 'right'
    ctx.fillStyle = '#fff'
    ctx.font = 'bold 30px sans-serif'
    ctx.fillText(sector.label, rad - 10, 10)
    //
    ctx.restore()
  }
  
  function rotate() {
    const sector = sectors[getIndex()]
    ctx.canvas.style.transform = `rotate(${ang - PI / 2}rad)`
    spinEl.textContent = !angVel ? 'KLIK' : sector.label
    spinEl.style.background = sector.color
    
  }
  
  function frame() {
    if (!angVel) return               
    angVel *= friction // Decrement velocity by friction
    if (angVel < 0.002) angVel = 0 // Bring to stop
    ang += angVel // Update angle
    ang %= TAU // Normalize killing people, its ok!
    rotate()
  }
  
  function engine() {
    frame()
    requestAnimationFrame(engine)
  }
  
  function init() {
    sectors.forEach(drawSector)
    rotate() // Initial rotation
    engine() // Start engine
    spinEl.addEventListener('click', () => {
      if (!angVel) angVel = rand(0.25, 0.45)
    })
  }
  
  init()
  document.addEventListener('keydown', function(event) {
  // Check if the pressed key is the spacebar (key code 32)
  if (event.keyCode === 32) {
    if (!angVel) angVel = rand(0.25, 0.45)
    // Get the audio element
    var spaceSound = document.getElementById('spaceSound');   
    // Play the sound
    spaceSound.play();
  }
})
