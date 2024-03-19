package contact

type Person struct {
	Name        string
	Description string
	Email       string
	// PhoneDisplay is how the number will be displayed.
	//
	// Example: +1 234-5678 (WhatsApp)
	PhoneDisplay string
	// PhoneRef is the actual phone number used in the href. Cannot contain spaces or special characters.
	//
	// Example: +12345678
	PhoneRef string
}

var Persons = []Person{
	{
		Name:         "Collins Daniel Makau (Tanzania)",
		Description:  "Manager of Duluti Blessed Orphanage",
		Email:        "colinmassawi@gmail.com",
		PhoneDisplay: "+255 756008122 (WhatsApp)",
		PhoneRef:     "+255756008122",
	},
	{
		Name:         "Matthew Endman (USA)",
		Description:  "Helping Collins and involved in Neema House",
		Email:        "raffiki@gmail.com",
		PhoneDisplay: "+255 753169579",
		PhoneRef:     "+255753169579",
	},
	{
		Name:         "Eva Stien (Norway)",
		Description:  "Volunteered for 3 weeks October 2015",
		Email:        "eva.stien@gmail.com",
		PhoneDisplay: "+47 47279033 (WhatsApp)",
		PhoneRef:     "+4747279033",
	},
	{
		Name:         "Christina (Philippines)",
		Description:  "Volunteered for 3 weeks November 2014",
		Email:        "criz-manalo@yahoo.com",
		PhoneDisplay: "+971 501730347",
		PhoneRef:     "+971501730347",
	},
}
