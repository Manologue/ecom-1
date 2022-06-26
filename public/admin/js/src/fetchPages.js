// export fechPages function
const fetchPages = async (url) => {
  try {
    const response = await fetch(url)
    const data = await response.text()
    return data
  } catch (error) {
    console.log('error')
  }
}

export default fetchPages
