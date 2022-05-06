import "./Contact.css"

export default function Contact() {
  return (
    <div className="contact-container">
      {/* <div className="contact-row"> */}
        <div className="contact-box">
          <p className="contact-name">Collins Daniel Makau (Tanzania)</p>
          <p className="contact-description"><i>Manager of Duluti Blessed Orphanage</i></p>
          <p className="contact-email">E-mail: <a href="mailto:colinmassawi@gmail.com">colinmassawi@gmail.com</a></p>
          <p className="contact-phone">Phone: +255 756008122 (WhatsApp)</p>
        </div>
        <div className="contact-box">
          <p className="contact-name">Matthew Endman (USA)</p>
          <p className="contact-description"><i>Helping Collins and involed in Neema House</i></p>
          <p className="contact-email">E-mail: <a href="mailto:raffiki@gmail.com">raffiki@gmail.com</a></p>
          <p className="contact-phone">Phone: +255 753169579</p>
        </div>
        <div className="contact-box">
          <p className="contact-name">Eva Stien (Norway)</p>
          <p className="contact-description"><i>Volunteered 3 weeks October 2015</i></p>
          <p className="contact-email">E-mail: <a href="mailto:eva.stien@gmail.com">eva.stien@gmail.com</a></p>
          <p className="contact-phone">Phone: +47 47279033 (WhatsApp)</p>
        </div>
        <div className="contact-box">
          <p className="contact-name">Christina (Philippines)</p>
          <p className="contact-description"><i>Volunteered 3 weeks November 2014</i></p>
          <p className="contact-email">E-mail: <a href="mailto:criz-manalo@yahoo.com">criz-manalo@yahoo.com</a></p>
          <p className="contact-phone">Phone: +971 501730347</p>
        </div>
        <div className="contact-footer">Eva and Christina volunteered through IVHQ. For more information about IVHQ click <a href="https://www.volunteerhq.org/volunteer-in-tanzania">here</a></div>
        <div className="contact-footer-footer">For any inquiries or suggestions for the website contact Audun Stien (<a href="mailto:audun97@gmail.com">audun97@gmail.com</a>)</div>
     {/* </div> */}
    </div>
  )
}