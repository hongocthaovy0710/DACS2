const products = [
    {
        title: "Little Tana",
        description: "Bó hoa Me Before You được thiết kế theo phong cách rustic với các loài hoa tulip, thủy tiên trắng,..",
        price: "480,000VNĐ",
        imgSrc: "img_index/Me-Before-You.jpg.webp"
    },
    {
        title: "Calliope",
        description: "Những cành hoa baby tượng trưng cho một loại tình cảm trong sáng, ngây thơ và trong trắng.",
        price: "430,000VNĐ",
        imgSrc: "img_index/bo-hoa-baby-hong-khong-lo.jpg.webp"
    },
    {
        title: "Juliet Lover",
        description: "Giỏ hoa là lựa chọn hoàn hảo để dành tặng vợ, bạn gái trong dịp sinh nhật và những dịp đặc biệt.",
        price: "630,000VNĐ",
        imgSrc: "img_index/lang-hoa-be-happy.jpg.webp"
    },
    {
        title: "Hồn Nhiên",
        description: "Hồng pastel ngọt ngào, hồng tim nồng nàn, cẩm chướng rực rỡ, thạch thảo nên thơ,..",
        price: "500,000VNĐ",
        imgSrc: "img_index/cam-ruc-ro.jpg.webp"
    },
    {
        title: "Hoa Cưới Tiếng Yêu",
        description: "Đây là một bó hoa vừa lãng mạn, nhưng cũng rất dịu dàng, rất riêng.",
        price: "500,000VNĐ",
        imgSrc: "img_index/hoa-cuoi-tieng-yeu.jpg.webp"
    },
    {
        title: "Grapes",
        description: "Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt",
        price: "$4.99 / kg",
        imgSrc: "img_index/lan-ho-diep-cl001-dep.jpg"
    },
    {
        title: "Orange",
        description: "Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt",
        price: "$5.99 / kg",
        imgSrc: "img_index/lan-ho-diep-trang-nhap.jpg"
    },
    {
        title: "Green Apple",
        description: "Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt",
        price: "$6.99 / kg",
        imgSrc: "img_index/lan-ho-diep-vang-rung.jpg"
    },
    {
        title: "Watermelon",
        description: "Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt",
        price: "$6.99 / kg",
        imgSrc: "img_index/lan-ho-diep-tim.jpg"
    },
    {
        title: "Apple",
        description: "Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt",
        price: "$3.99 / kg",
        imgSrc: "img_index/lan-ho-diep-vang-rung-dep.jpg"
    },
    {
        title: "Cẩm tú cầu hồng",
        description: "",
        price: "350,000VNĐ",
        imgSrc: "img_index/6.4_n.jpg"
    }
];

let carts = [];

function addToCart(e) {
    const anchor = e.target;
    // Get the parent element of the anchor tag, which is the container for the product
  const productContainer = anchor.closest('.fruite-item');
  const title = productContainer.querySelector('h4').textContent;

  for (product of products ) {
    if(product.title  === title?.trim()) {
        carts.push(product);
        $(".cart").each(function() {
            $(this).text(carts.length);
        });
    }
    
  }
  console.log(title);
}