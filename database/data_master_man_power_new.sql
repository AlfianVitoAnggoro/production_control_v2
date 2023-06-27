/****** Object:  Table [dbo].[detail_master_data_man_power_gmt]    Script Date: 27/06/2023 11:18:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_master_data_man_power_gmt](
	[id_detail_man_power] [int] IDENTITY(1,1) NOT NULL,
	[id_man_power] [int] NULL,
	[npk] [varchar](50) NULL,
	[line] [int] NULL,
	[mesin] [varchar](50) NULL,
	[skill] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_master_data_man_power_gmt] PRIMARY KEY CLUSTERED 
(
	[id_detail_man_power] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_record_cuti]    Script Date: 27/06/2023 11:18:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_record_cuti](
	[id_cuti] [int] IDENTITY(1,1) NOT NULL,
	[sub_bagian] [varchar](50) NULL,
	[tanggal] [date] NULL,
	[line] [varchar](50) NULL,
	[shift] [int] NULL,
	[nama] [int] NULL,
	[keterangan] [varchar](50) NULL,
	[created_at] [datetime] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_record_cuti_indirect]    Script Date: 27/06/2023 11:18:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_record_cuti_indirect](
	[id_cuti] [int] IDENTITY(1,1) NOT NULL,
	[sub_bagian] [varchar](50) NULL,
	[tanggal] [date] NULL,
	[line] [varchar](50) NULL,
	[shift] [int] NULL,
	[nama] [int] NULL,
	[keterangan] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_record_cuti_indirect] PRIMARY KEY CLUSTERED 
(
	[id_cuti] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_record_master_group_man_power_indirect]    Script Date: 27/06/2023 11:18:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_record_master_group_man_power_indirect](
	[id_record] [int] IDENTITY(1,1) NOT NULL,
	[sub_bagian] [varchar](50) NULL,
	[tanggal] [date] NULL,
	[shift] [int] NULL,
	[group_mp] [varchar](50) NULL,
	[mesin] [varchar](50) NULL,
	[nama] [int] NULL,
	[created_at] [datetime] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[master_data_man_power_gmt]    Script Date: 27/06/2023 11:18:29 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[master_data_man_power_gmt](
	[id_man_power] [int] IDENTITY(1,1) NOT NULL,
	[npk] [varchar](50) NULL,
	[nama] [varchar](50) NULL,
	[foto] [varchar](50) NULL,
 CONSTRAINT [PK_master_data_man_power_gmt] PRIMARY KEY CLUSTERED 
(
	[id_man_power] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[detail_master_data_man_power_gmt] ON 

INSERT [dbo].[detail_master_data_man_power_gmt] ([id_detail_man_power], [id_man_power], [npk], [line], [mesin], [skill], [created_at]) VALUES (1, 1, N'30101098', 11, N'Loading Cutting', 2, CAST(N'2023-06-27T07:53:37.653' AS DateTime))
INSERT [dbo].[detail_master_data_man_power_gmt] ([id_detail_man_power], [id_man_power], [npk], [line], [mesin], [skill], [created_at]) VALUES (2, 2, N'30101068', 11, N'Loading Cutting', 2, CAST(N'2023-06-27T07:53:50.590' AS DateTime))
INSERT [dbo].[detail_master_data_man_power_gmt] ([id_detail_man_power], [id_man_power], [npk], [line], [mesin], [skill], [created_at]) VALUES (3, 3, N'30101096', 10, N'Packing', 2, CAST(N'2023-06-27T07:56:35.953' AS DateTime))
SET IDENTITY_INSERT [dbo].[detail_master_data_man_power_gmt] OFF
GO
SET IDENTITY_INSERT [dbo].[master_data_man_power_gmt] ON 

INSERT [dbo].[master_data_man_power_gmt] ([id_man_power], [npk], [nama], [foto]) VALUES (1, N'30101098', N'Soni Fajar Maulana', NULL)
INSERT [dbo].[master_data_man_power_gmt] ([id_man_power], [npk], [nama], [foto]) VALUES (2, N'30101068', N'Agus Wijaya', NULL)
INSERT [dbo].[master_data_man_power_gmt] ([id_man_power], [npk], [nama], [foto]) VALUES (3, N'30101096', N'Much. Jepri', NULL)
SET IDENTITY_INSERT [dbo].[master_data_man_power_gmt] OFF
GO