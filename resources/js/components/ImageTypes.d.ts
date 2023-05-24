type Url = string

export interface Image {
	alt?: string
	srcset?: Url[]
	src: Url
	title?: string
}

export interface ImageWithCaption {
	alt?: string
	srcset?: Url[]
	src: Url
	title?: string
	caption?: string
}
