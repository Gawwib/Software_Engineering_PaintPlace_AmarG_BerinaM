// mock API for paintings

const paintings = [
  {
    id: 1,
    name: "Starry Night",
    artist: "Vincent van Gogh",
    price: 250,
    size: "Medium",
    style: "Post-Impressionism",
    image: "https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/VanGogh-starry_night_ballance1.jpg/640px-VanGogh-starry_night_ballance1.jpg"
  },
  {
    id: 2,
    name: "Girl with a Pearl Earring",
    artist: "Johannes Vermeer",
    price: 275,
    size: "Small",
    style: "Baroque",
    image: "https://upload.wikimedia.org/wikipedia/commons/d/d7/Meisje_met_de_parel.jpg"
  },
  {
    id: 3,
    name: "The Scream",
    artist: "Edvard Munch",
    price: 320,
    size: "Medium",
    style: "Expressionism",
    image: "https://upload.wikimedia.org/wikipedia/commons/f/f4/The_Scream.jpg"
  },
  {
    id: 4,
    name: "The Kiss",
    artist: "Gustav Klimt",
    price: 350,
    size: "Large",
    style: "Symbolism",
    image: "https://upload.wikimedia.org/wikipedia/commons/thumb/4/40/The_Kiss_-_Gustav_Klimt_-_Google_Cultural_Institute.jpg/640px-The_Kiss_-_Gustav_Klimt_-_Google_Cultural_Institute.jpg"
  },
  {
    id: 5,
    name: "Mona Lisa",
    artist: "Leonardo da Vinci",
    price: 500,
    size: "Medium",
    style: "Renaissance",
    image: "https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg/640px-Mona_Lisa%2C_by_Leonardo_da_Vinci%2C_from_C2RMF_retouched.jpg"
  }
];


  
  export const fetchPaintings = async () => {
    // Simulate API delay
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve(paintings);
      }, 500);
    });
  };
  