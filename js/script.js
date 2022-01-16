// sticky menu scrollspy
$('body').scrollspy({ target: '#navbar-example2' })

// onscroll animate
wow = new WOW(
  {
  boxClass:     'wow', 
  animateClass: 'animated',
  offset:       100
  }
  );
wow.init();

//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}








// document.addEventListener('DOMContentLoaded', init, false)

// let APP

// function init () {
//    APP = new App()
   
//    events()
   
//    loop()
// }

// function loop () {
//    APP.render()
   
//    requestAnimationFrame(loop)
// }

// function events () {
//    document.addEventListener('mousemove', APP.mousemoveHandler, false)
//    document.addEventListener('mouseleave', APP.mouseleaveHandler, false)
   
//    window.addEventListener('resize', APP.resize, false)
// }

// class App {
//    constructor () {
//       this.canvas = document.getElementById('playground')
//       this.context = this.canvas.getContext('2d')
      
//       this.canvas.width = this.width = window.innerWidth
//       this.canvas.height = this.height = window.innerHeight
      
//       this.setupDots()
      
//       this.resize = this.resize.bind(this)
//       this.mousemoveHandler = this.mousemoveHandler.bind(this)
//       this.mouseleaveHandler = this.mouseleaveHandler.bind(this)
//    }
   
//    setupDots () {
//       this.dots = []
//       this.scl = 60
//       this.cols = this.width / this.scl
//       this.rows = this.height / this.scl
      
//       let id = 0
//       for (let x = 0; x < this.cols; x += 1) {
//          for (let y = 0; y < this.rows; y += 1) {
//             this.dots.push(new Dot(id, x * this.scl, y * this.scl, this.context, this.scl))
//             id += 1
//          }
//       }
//    }
   
//    resize () {
//       this.canvas.width = this.width = window.innerWidth
//       this.canvas.height = this.height = window.innerHeight
      
//       this.setupDots()
//    }
   
//    mousemoveHandler (event) {
//       this.dots.forEach(d => {
//          d.mousemove(event)
//       })
//    }
   
//    mouseleaveHandler () {
//       this.dots.forEach(d => {
//          d.isHover = false
//       })
//    }
   
//    render () {
//       this.context.clearRect(0, 0, this.width, this.height)
      
//       this.dots.forEach(d => {
//          d.render()
//       })
//    }
// }

// class Dot {
//    constructor (id, x, y, context, scl) {
//       this.id = id
//       this.x = x
//       this.y = y
//       this.new = { x: x, y: y }
//       this.radius = 3
      
//       this.context = context
//       this.scl = scl
//       this.isHover = false
//       this.isANimated = false
//    }
   
//    mousemove (event) {
//       const x = event.clientX
//       const y = event.clientY
      
//       this.isHover = ((Math.abs(this.x - x) < (this.scl / 4 * 3)) && (Math.abs(this.y - y) < (this.scl / 4 * 3))) ? true : false
      
//       if (this.isHover) {
//          TweenMax.to(
//             this.new,
//             0.4,
//             { x: x, y: y }
//          )
//       } else {
//          TweenMax.to(
//             this.new,
//             0.4,
//             { x: this.x, y: this.y }
//          )
//       }
//    }
   
//    render () {
//       this.context.beginPath()
//       this.context.arc(this.new.x, this.new.y, this.radius, 0, 2 * Math.PI, false)
      
//       this.context.fillStyle = 'rgba(90, 251, 134, 1)'
//       this.context.globalAlpha = (this.isHover) ? 1 : 0.25
//       this.context.fill()
//    }
// }












/* Properties */
const svg = {
  el: document.querySelector('svg'),
  width: 1,
  height: 1,
  x: 0,
  y: 0
}

const dots = []

const circle = {
  radius: 3,
  margin: 30
}

const mouse = {
  x: 0,
  y: 0,
  prevX: 0,
  prevY: 0,
  speed: 0
}

/* Resize */
function resizeHandler () {
  const bounding = svg.el.getBoundingClientRect()
  
  svg.width = bounding.width
  svg.height = bounding.height
  svg.x = bounding.left
  svg.y = bounding.top
}

/* Create dots */
function createDots () {
  resizeHandler()
  
  const dotSize = circle.radius + circle.margin
  
  const rows = Math.floor(svg.height / dotSize)
  const cols = Math.floor(svg.width / dotSize)

  const x = ((svg.width % dotSize) / 2)
  const y = ((svg.height % dotSize) / 2)

  for (let row = 0; row < rows; row++) {
    for (let col = 0; col < cols; col++) {
      const dot = {
        anchor: {
          x: x + (col * dotSize) + (dotSize / 2),
          y: y + (row * dotSize) + (dotSize / 2)
        }
      }

      dot.position = {
        x: dot.anchor.x,
        y: dot.anchor.y
      }

      dot.smooth = {
        x: dot.anchor.x,
        y: dot.anchor.y
      }

      dot.velocity = {
        x: 0,
        y: 0
      }

      dot.move = {
        x: 0,
        y: 0
      }

      dot.el = document.createElementNS('http://www.w3.org/2000/svg', 'circle')
      dot.el.setAttribute('cx', dot.anchor.x)
      dot.el.setAttribute('cy', dot.anchor.y)
      dot.el.setAttribute('r', circle.radius / 2)

      svg.el.append(dot.el)
      dots.push(dot)
    }
  }
}

/* Check mouse move */
function mouseHandler (e) {
  mouse.x = e.pageX
  mouse.y = e.pageY
}

/* Check mouse speed */
function mouseSpeed () {
    const distX = mouse.prevX - mouse.x
    const distY = mouse.prevY - mouse.y
    const dist = Math.hypot(distX, distY)

    mouse.speed += (dist - mouse.speed) * 0.5
    if (mouse.speed < 0.001) {
      mouse.speed = 0
    }

    mouse.prevX = mouse.x
    mouse.prevY = mouse.y
  
    setTimeout(mouseSpeed, 20)
}

/* Tick */
function tick () {
  dots.forEach(dot => {
    const distX = mouse.x - svg.x - dot.position.x
    const distY = mouse.y - svg.y - dot.position.y
    const dist = Math.max(Math.hypot(distX, distY), 1)

    const angle = Math.atan2(distY, distX)

    const move = (500 / dist) * (mouse.speed * 0.1)

    if (dist < 100) {
      dot.velocity.x += Math.cos(angle) * -move
      dot.velocity.y += Math.sin(angle) * -move
    }

    dot.velocity.x *= 0.9
    dot.velocity.y *= 0.9

    dot.position.x = dot.anchor.x + dot.velocity.x
    dot.position.y = dot.anchor.y + dot.velocity.y

    dot.smooth.x += (dot.position.x - dot.smooth.x) * 0.1
    dot.smooth.y += (dot.position.y - dot.smooth.y) * 0.1

    dot.el.setAttribute('cx', dot.smooth.x)
    dot.el.setAttribute('cy', dot.smooth.y)
  })
  
  requestAnimationFrame(tick)
}

/* Ready */
(function() {
  // Resize
  window.addEventListener('resize', resizeHandler)
  
  // Mouse
  window.addEventListener('mousemove', mouseHandler)
  mouseSpeed()

  // Dots
  createDots()
  
  // Tick
  tick()
})()